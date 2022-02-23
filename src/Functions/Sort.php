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

namespace MUtils\Sort;

use function arsort as PHPArsort;
use function asort as PHPAsort;
use function krsort as PHPKrsort;
use function ksort as PHPKsort;
use function natcasesort as PHPNatcasesort;
use function natsort as PHPNatsort;
use function rsort as PHPRsort;
use function sort as PHPSort;
use function uasort as PHPUasort;
use function uksort as PHPUksort;
use function usort as PHPUsort;

/**
 * Compares the provided values based on the flag based sort comparison logic
 *
 * @param mixed $a
 * @param mixed $b
 */
function array_compare_flags($a, $b, int $flags): int
{
    if ($a === $b) {
        return 0;
    }

    switch ($flags) {
        case SORT_STRING:
            return strcmp($a, $b);

        case SORT_STRING | SORT_FLAG_CASE:
            return strcasecmp($a, $b);

        case SORT_NATURAL:
            return strnatcmp((string) $a, (string) $b);

        case SORT_NATURAL | SORT_FLAG_CASE:
            return strnatcasecmp((string) $a, (string) $b);

        case SORT_LOCALE_STRING:
            return strcoll($a, $b);

        case SORT_NUMERIC:
            return (float) $a <=> (float) $b;

        default:
            return $a <=> $b;
    }
}

/**
 * Stretches the information Key, Value and Index as an array-item
 */
function array_stretch_information(array $array): array
{
    $stretched = array_keys($array);

    foreach ($stretched as $index => $key) {
        $stretched[$index] = ['key' => $key, 'value' => $array[$key], 'index' => $index];
    }

    return $stretched;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \arsort()
 */
function arsort(array &$array, int $flags = SORT_REGULAR): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPArsort($array, $flags);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($flags) {
        return array_compare_flags($right['value'], $left['value'], $flags) ?: $left['index'] <=> $right['index'];
    });
    $array = (array) array_combine(array_column($stretched, 'key'), array_column($stretched, 'value'));

    return $result;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \asort()
 */
function asort(array &$array, int $flags = SORT_REGULAR): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPAsort($array, $flags);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($flags) {
        return array_compare_flags($left['value'], $right['value'], $flags) ?: $left['index'] <=> $right['index'];
    });
    $array = (array) array_combine(array_column($stretched, 'key'), array_column($stretched, 'value'));

    return $result;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \krsort()
 */
function krsort(array &$array, int $flags = SORT_REGULAR): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPKrsort($array, $flags);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($flags) {
        return array_compare_flags($right['key'], $left['key'], $flags) ?: $left['index'] <=> $right['index'];
    });
    $array = (array) array_combine(array_column($stretched, 'key'), array_column($stretched, 'value'));

    return $result;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \ksort()
 */
function ksort(array &$array, int $flags = SORT_REGULAR): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPKsort($array, $flags);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($flags) {
        return array_compare_flags($left['key'], $right['key'], $flags) ?: $left['index'] <=> $right['index'];
    });
    $array = (array) array_combine(array_column($stretched, 'key'), array_column($stretched, 'value'));

    return $result;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \natcasesort()
 */
function natcasesort(array &$array): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPNatcasesort($array);
    }

    return asort($array, SORT_NATURAL | SORT_FLAG_CASE);
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \natsort()
 */
function natsort(array &$array): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPNatsort($array);
    }

    return asort($array, SORT_NATURAL);
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \rsort()
 */
function rsort(array &$array, int $flags = SORT_REGULAR): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPRsort($array, $flags);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($flags) {
        return array_compare_flags($right['value'], $left['value'], $flags) ?: $left['index'] <=> $right['index'];
    });
    $array = array_column($stretched, 'value');

    return $result;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \sort()
 */
function sort(array &$array, int $flags = SORT_REGULAR): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPSort($array, $flags);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($flags) {
        return array_compare_flags($left['value'], $right['value'], $flags) ?: $left['index'] <=> $right['index'];
    });
    $array = array_column($stretched, 'value');

    return $result;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \uasort()
 */
function uasort(array &$array, callable $callback): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPUasort($array, $callback);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($callback) {
        return $callback($left['value'], $right['value']) ?: $left['index'] <=> $right['index'];
    });
    $array = (array) array_combine(array_column($stretched, 'key'), array_column($stretched, 'value'));

    return $result;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \uksort()
 */
function uksort(array &$array, callable $callback): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPUksort($array, $callback);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($callback) {
        return $callback($left['key'], $right['key']) ?: $left['index'] <=> $right['index'];
    });
    $array = (array) array_combine(array_column($stretched, 'key'), array_column($stretched, 'value'));

    return $result;
}

/**
 * This function checks the PHP version and uses the same stable sort logic for older PHP versions as 8.0
 *
 * IMPORTANT: it's slower than usual!
 *
 * @see \usort()
 */
function usort(array &$array, callable $callback): bool
{
    if (version_compare(phpversion(), '8.0.0', '>=')) {
        return PHPUsort($array, $callback);
    }

    $stretched = array_stretch_information($array);
    $result = PHPUsort($stretched, static function ($left, $right) use ($callback) {
        return $callback($left['value'], $right['value']) ?: $left['index'] <=> $right['index'];
    });
    $array = array_column($stretched, 'value');

    return $result;
}
