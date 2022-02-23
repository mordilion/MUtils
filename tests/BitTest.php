<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function MUtils\Bit\bit_isset;
use function MUtils\Bit\bit_set;
use function MUtils\Bit\bit_unset;
use function MUtils\Strings\str_ends_with as UtilsStrEndsWith;
use function MUtils\Strings\str_starts_with as UtilsStrStartsWith;

final class BitTest extends TestCase
{
    public function testBitIsset(): void
    {
        $set = 2 | 16;

        $this->assertTrue(bit_isset($set, 2)); // 2
        $this->assertTrue(bit_isset($set, 18)); // 2 & 16
        $this->assertTrue(bit_isset($set, 16)); // 16

        $this->assertFalse(bit_isset($set, 4)); // 4
        $this->assertFalse(bit_isset($set, 8)); // 8
        $this->assertFalse(bit_isset($set, 6)); // 2 & 4
    }

    public function testBitSet(): void
    {
        $set = 2;

        $this->assertEquals(2, bit_set($set, 0));
        $this->assertEquals(2, bit_set($set, 2));
        $this->assertEquals(10, bit_set($set, 8));
        $this->assertEquals(6, bit_set($set, 4));
    }

    public function testBitUnset(): void
    {
        $set = 2 | 16;

        $this->assertEquals(18, bit_unset($set, 0));
        $this->assertEquals(16, bit_unset($set, 2));
        $this->assertEquals(2, bit_unset($set, 16));
        $this->assertEquals(0, bit_unset($set, 18));
        $this->assertEquals(18, bit_unset($set, 8));
    }
}
