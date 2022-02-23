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

class Sort
{
    public static function compareFlags($a, $b, int $flags): int
    {
        return Sort\array_compare_flags($a, $b, $flags);
    }

    public static function associativeReverseSort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Sort\arsort($array, $flags);
    }

    public static function associativeSort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Sort\asort($array, $flags);
    }

    public static function keyReverseSort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Sort\krsort($array, $flags);
    }

    public static function keySort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Sort\ksort($array, $flags);
    }

    public static function naturalCaseInsensitiveSort(array &$array): bool
    {
        return Sort\natcasesort($array);
    }

    public static function naturalSort(array &$array): bool
    {
        return Sort\natsort($array);
    }

    public static function reverseSort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Sort\rsort($array, $flags);
    }

    public static function sort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Sort\sort($array, $flags);
    }

    public static function userAssociativeSort(array &$array, callable $callback): bool
    {
        return Sort\uasort($array, $callback);
    }

    public static function userKeySort(array &$array, callable $callback): bool
    {
        return Sort\uksort($array, $callback);
    }

    public static function userSort(array &$array, callable $callback): bool
    {
        return Sort\usort($array, $callback);
    }
}
