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

namespace MUtils\Strings;

use function str_contains as PHPStrContains;
use function str_ends_with as PHPStrEndsWith;
use function str_starts_with as PHPStrStartsWith;

function str_contains(string $haystack, string $needle): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPStrContains($haystack, $needle);
    }

    return mb_strpos($haystack, $needle) !== false;
}

function str_ends_with(string $haystack, string $needle): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPStrEndsWith($haystack, $needle);
    }

    $length = mb_strlen($needle);
    if (!$length) {
        return true;
    }

    return mb_substr($haystack, -$length) === $needle;
}

function str_starts_with(string $haystack, string $needle): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPStrStartsWith($haystack, $needle);
    }

    return mb_strpos($haystack, $needle) === 0;
}
