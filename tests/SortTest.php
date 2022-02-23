<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function MUtils\Sort\arsort as UtilsArsort;
use function MUtils\Sort\asort as UtilsAsort;
use function MUtils\Sort\krsort as UtilsKrsort;
use function MUtils\Sort\ksort as UtilsKsort;
use function MUtils\Sort\natcasesort as UtilsNatcasesort;
use function MUtils\Sort\natsort as UtilsNatsort;
use function MUtils\Sort\rsort as UtilsRsort;
use function MUtils\Sort\sort as UtilsSort;
use function MUtils\Sort\uasort as UtilsUasort;
use function MUtils\Sort\uksort as UtilsUksort;

final class SortTest extends TestCase
{
    /*
    public function testTimeMeasureForUasort(): void
    {
        $times = ['original' => 0, 'replacement' => 0];

        $input = range(0, 50000);
        $times['replacement'] = microtime(true);
        for ($i = 0; $i < 1; $i++) {
            UtilsUasort($input, static function ($left, $right) {
                return $left <=> $right;
            });
        }
        $times['replacement'] = microtime(true) - $times['replacement'];

        $times['original'] = microtime(true);
        $input = range(0, 50000);
        for ($i = 0; $i < 1; $i++) {
            uasort($input, static function ($left, $right) {
                return $left <=> $right;
            });
        }
        $times['original'] = microtime(true) - $times['original'];

        var_dump($times);
    }
    */

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
}
