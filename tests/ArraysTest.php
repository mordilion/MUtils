<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function MUtils\Arrays\array_group_by as UtilsArrayGroupBy;
use function MUtils\Arrays\array_move_element;
use function MUtils\Arrays\array_prefix_add;
use function MUtils\Arrays\array_prefix_remove;
use function MUtils\Arrays\arsort as UtilsArsort;
use function MUtils\Arrays\asort as UtilsAsort;
use function MUtils\Arrays\krsort as UtilsKrsort;
use function MUtils\Arrays\ksort as UtilsKsort;
use function MUtils\Arrays\natcasesort as UtilsNatcasesort;
use function MUtils\Arrays\natsort as UtilsNatsort;
use function MUtils\Arrays\rsort as UtilsRsort;
use function MUtils\Arrays\sort as UtilsSort;
use function MUtils\Arrays\uasort as UtilsUasort;
use function MUtils\Arrays\uksort as UtilsUksort;

final class ArraysTest extends TestCase
{
    private const GROUP_DATA = [
        'chris' => [
            'state' => 'TX',
            'city' => 'Dallas',
            'name' => 'Chris Louis'
        ],
        'alex' => [
            'state' => 'TX',
            'city' => 'Houston',
            'name' => 'Alex Spencer'
        ],
        'caroline' => [
            'state' => 'TX',
            'city' => 'Dallas',
            'name' => 'Caroline Hetchfield'
        ],
        'derrick' => [
            'state' => 'CA',
            'city' => 'San Diego',
            'name' => 'Derrick Miller'
        ],
        'lee' => [
            'state' => 'CA',
            'city' => 'Mountain View',
            'name' => 'Lee Swanson'
        ],
    ];

    public function testArrayGroupByWithNamedColumn(): void
    {
        $expected = [
            'TX' => [
                [
                    'state' => 'TX',
                    'city' => 'Dallas',
                    'name' => 'Chris Louis'
                ],
                [
                    'state' => 'TX',
                    'city' => 'Houston',
                    'name' => 'Alex Spencer'
                ],
                [
                    'state' => 'TX',
                    'city' => 'Dallas',
                    'name' => 'Caroline Hetchfield'
                ],
            ],
            'CA' => [
                [
                    'state' => 'CA',
                    'city' => 'San Diego',
                    'name' => 'Derrick Miller'
                ],
                [
                    'state' => 'CA',
                    'city' => 'Mountain View',
                    'name' => 'Lee Swanson'
                ],
            ],
        ];
        $grouped = UtilsArrayGroupBy(self::GROUP_DATA, false,'state');

        $this->assertSame($expected, $grouped);
    }

    public function testArrayGroupByWithTwoNamedColumns(): void
    {
        $expected = [
            'TX' => [
                'Dallas' => [
                    'chris' => [
                        'state' => 'TX',
                        'city' => 'Dallas',
                        'name' => 'Chris Louis'
                    ],
                    'caroline' => [
                        'state' => 'TX',
                        'city' => 'Dallas',
                        'name' => 'Caroline Hetchfield'
                    ],
                ],
                'Houston' => [
                    'alex' => [
                        'state' => 'TX',
                        'city' => 'Houston',
                        'name' => 'Alex Spencer'
                    ],
                ],
            ],
            'CA' => [
                'San Diego' => [
                    'derrick' => [
                        'state' => 'CA',
                        'city' => 'San Diego',
                        'name' => 'Derrick Miller'
                    ],
                ],
                'Mountain View' => [
                    'lee' => [
                        'state' => 'CA',
                        'city' => 'Mountain View',
                        'name' => 'Lee Swanson'
                    ],
                ],
            ],
        ];
        $grouped = UtilsArrayGroupBy(self::GROUP_DATA, true,'state', 'city');

        $this->assertSame($expected, $grouped);
    }

    public function testArrayPrefixAddAddsTheProvidedPrefix(): void
    {
        $input = ['test1', 'test2', 'test3'];
        $expected = ['prefix_0', 'prefix_1', 'prefix_2'];

        $newArray = array_prefix_add($input, 'prefix_');

        $this->assertEquals($expected, array_keys($newArray));
    }

    public function testArrayPrefixAddAddsNoPrefixIfEmptyPrefixIsProvided(): void
    {
        $input = ['test1', 'test2', 'test3'];
        $expected = [0, 1, 2];

        $newArray = array_prefix_add($input, '');

        $this->assertEquals($expected, array_keys($newArray));
    }

    public function testArrayPrefixRemoveRemovesTheProvidedPrefix(): void
    {
        $input = ['prefix_0' => 'test1', 'different_prefix_1' => 'test2', 'prefix_2' => 'test3'];
        $expected = [0, 'different_prefix_1', 2];

        $newArray = array_prefix_remove($input, 'prefix_');

        $this->assertEquals($expected, array_keys($newArray));

        $expected = [1, 2, 3];
        $newArray = array_prefix_remove($input, 'test', ARRAY_PREFIX_VALUE);

        $this->assertEquals($expected, array_values($newArray));
    }

    public function testArrayPrefixRemoveRemovesNoPrefixIfEmptyPrefixIsProvided(): void
    {
        $input = ['prefix_0' => 'test1', 'different_prefix_1' => 'test2', 'prefix_2' => 'test3', 4 => 'test4'];
        $expected = ['prefix_0', 'different_prefix_1', 'prefix_2', 4];

        $newArray = array_prefix_remove($input, '');

        $this->assertEquals($expected, array_keys($newArray));
    }

    public function testArsortHasAStableSortedResult(): void
    {
        $input = ['b' => 'Banane', 'c' => 'Apfel', 'd' => 'Zitrone', 'a' => 'Orange'];
        $expected = ['d' => 'Zitrone', 'a' => 'Orange', 'b' => 'Banane', 'c' => 'Apfel'];

        UtilsArsort($input);

        $this->assertSame($expected, $input);
    }

    public function testAsortHasAStableSortedResult(): void
    {
        $input = ['d' => 'Zitrone', 'a' => 'Orange', 'b' => 'Banane', 'c' => 'Apfel'];
        $expected = ['c' => 'Apfel', 'b' => 'Banane', 'a' => 'Orange', 'd' => 'Zitrone'];

        UtilsAsort($input);

        $this->assertSame($expected, $input);
    }

    public function testKrsortHasAStableSortedResult(): void
    {
        $input = ['c' => 'Apfel', 'd' => 'Zitrone', 'a' => 'Orange', 'b' => 'Banane'];
        $expected = ['d' => 'Zitrone', 'c' => 'Apfel', 'b' => 'Banane', 'a' => 'Orange'];

        UtilsKrsort($input);

        $this->assertSame($expected, $input);
    }

    public function testKsortHasAStableSortedResult(): void
    {
        $input = ['c' => 'Apfel', 'd' => 'Zitrone', 'a' => 'Orange', 'b' => 'Banane'];
        $expected = ['a' => 'Orange', 'b' => 'Banane', 'c' => 'Apfel', 'd' => 'Zitrone'];

        UtilsKsort($input);

        $this->assertSame($expected, $input);
    }

    public function testNatcasesortHasAStableSortedResult(): void
    {
        $input = [0 => 'IMG0.png', 1 => 'img12.png', 2 => 'img10.png', 3 => 'img2.png', 4 => 'img1.png', 5 => 'IMG3.png'];
        $expected = [0 => 'IMG0.png', 4 => 'img1.png', 3 => 'img2.png', 5 => 'IMG3.png', 2 => 'img10.png', 1 => 'img12.png'];

        UtilsNatcasesort($input);

        $this->assertSame($expected, $input);
    }

    public function testNatsortHasAStableSortedResult(): void
    {
        $input = [0 => 'IMG0.png', 1 => 'img12.png', 2 => 'img10.png', 3 => 'img2.png', 4 => 'img1.png', 5 => 'IMG3.png'];
        $expected = [0 => 'IMG0.png', 5 => 'IMG3.png', 4 => 'img1.png', 3 => 'img2.png', 2 => 'img10.png', 1 => 'img12.png'];

        UtilsNatsort($input);

        $this->assertSame($expected, $input);
    }

    public function testRsortHasAStableSortedResult(): void
    {
        $input = ['c' => 'Apfel', 'b' => 'Banane', 'd' => 'Zitrone', 'a' => 'Orange'];
        $expected = ['Zitrone', 'Orange', 'Banane', 'Apfel'];

        UtilsRsort($input);

        $this->assertSame($expected, $input);
    }

    public function testSortHasAStableSortedResult(): void
    {
        $input = ['c' => 'Apfel', 'b' => 'Banane', 'd' => 'Zitrone', 'a' => 'Orange'];
        $expected = ['Apfel', 'Banane', 'Orange', 'Zitrone'];

        UtilsSort($input);

        $this->assertSame($expected, $input);
    }

    public function testUasortHasAStableSortedResult(): void
    {
        $input = ['c' => 1, 'e' => 2, 'd' => 1, 'a' => 0, 'b' => 0, 'f' => 2];
        $expected = ['a' => 0, 'b' => 0, 'c' => 1, 'd' => 1, 'e' => 2, 'f' => 2];

        UtilsUasort($input, static function ($left, $right) {
            return $left <=> $right;
        });

        $this->assertSame($expected, $input);
    }

    public function testUksortHasAStableSortedResult(): void
    {
        $input = ['c' => 1, 'e' => 2, 'd' => 1, 'a' => 0, 'b' => 0, 'f' => 2];
        $expected = ['a' => 0, 'b' => 0, 'c' => 1, 'd' => 1, 'e' => 2, 'f' => 2];

        UtilsUksort($input, static function ($left, $right) {
            if ($left === chr(ord($right) - 1)) {
                return 0;
            }

            return $left <=> $right;
        });

        $this->assertSame($expected, $input);
    }

    public function testArrayMoveElement(): void
    {
        $input = ['a', 'c', 'd', 'e', 'b', 'f'];
        $expected = ['a', 'b', 'c', 'd', 'e', 'f'];

        array_move_element($input, 4, 1);

        $this->assertEquals($expected, $input);
    }
}
