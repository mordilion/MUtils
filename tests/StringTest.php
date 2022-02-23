<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function MUtils\Strings\str_ends_with as UtilsStrEndsWith;
use function MUtils\Strings\str_starts_with as UtilsStrStartsWith;

final class StringTest extends TestCase
{
    public function testStrStartsWithReturnsTrueForTheEqualStr(): void
    {
        $this->assertTrue(UtilsStrStartsWith('TestString', 'Test'));
        $this->assertTrue(UtilsStrStartsWith('a!) Something', 'a'));
        $this->assertTrue(UtilsStrStartsWith('§3 Something', '§'));
    }

    public function testStrStartsWithReturnsFalseForTheUnequalStr(): void
    {
        $this->assertFalse(UtilsStrStartsWith('TestString', '-'));
        $this->assertFalse(UtilsStrStartsWith('a!) Something', '123'));
        $this->assertFalse(UtilsStrStartsWith('§3 Something', '//'));
    }

    public function testStrEndsWithReturnsTrueForTheEqualStr(): void
    {
        $this->assertTrue(UtilsStrEndsWith('TestString', 'String'));
        $this->assertTrue(UtilsStrEndsWith('a!) Something', 'ing'));
        $this->assertTrue(UtilsStrEndsWith('Something 3§', '§'));
    }

    public function testStrEndsWithReturnsFalseForTheUnequalStr(): void
    {
        $this->assertFalse(UtilsStrEndsWith('TestString', '-'));
        $this->assertFalse(UtilsStrEndsWith('a!) Something', '123'));
        $this->assertFalse(UtilsStrEndsWith('§3 Something', '//'));
    }
}
