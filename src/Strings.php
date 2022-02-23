<?php

/**
 * This file is part of the MUtils package.
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 *
 * @copyright (c) Henning Huncke - <mordilion@gmx.de>
 */

declare(strict_types=1);

namespace MUtils;

class Strings
{
    public static function contains(string $haystack, string $needle): bool
    {
        return Strings\str_contains($haystack, $needle);
    }

    public static function endsWith(string $haystack, string $needle): bool
    {
        return Strings\str_ends_with($haystack, $needle);
    }

    public static function startsWith(string $haystack, string $needle): bool
    {
        return Strings\str_starts_with($haystack, $needle);
    }
}
