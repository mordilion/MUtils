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

class Arrays
{
    public static function addPrefix(array $array, string $prefix): array
    {
        return Arrays\array_prefix_add($array, $prefix);
    }

    public static function compareFlags($a, $b, int $flags): int
    {
        return Arrays\array_compare_flags($a, $b, $flags);
    }

    public static function moveElement(array &$array, int $fromIndex, int $toIndex): void
    {
        Arrays\array_move_element($array, $fromIndex, $toIndex);
    }

    public static function associativeReverseSort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Arrays\arsort($array, $flags);
    }

    public static function associativeSort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Arrays\asort($array, $flags);
    }

    public static function groupBy(array $array, bool $preserveKeys, $column): array
    {
        $args = func_get_args();

        return Arrays\array_group_by(...$args);
    }

    public static function keyReverseSort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Arrays\krsort($array, $flags);
    }

    public static function keySort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Arrays\ksort($array, $flags);
    }

    public static function naturalCaseInsensitiveSort(array &$array): bool
    {
        return Arrays\natcasesort($array);
    }

    public static function naturalSort(array &$array): bool
    {
        return Arrays\natsort($array);
    }

    public static function removePrefix(array $array, string $prefix): array
    {
        return Arrays\array_prefix_remove($array, $prefix);
    }

    public static function reverseSort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Arrays\rsort($array, $flags);
    }

    public static function sort(array &$array, int $flags = SORT_REGULAR): bool
    {
        return Arrays\sort($array, $flags);
    }

    public static function userAssociativeSort(array &$array, callable $callback): bool
    {
        return Arrays\uasort($array, $callback);
    }

    public static function userKeySort(array &$array, callable $callback): bool
    {
        return Arrays\uksort($array, $callback);
    }

    public static function userSort(array &$array, callable $callback): bool
    {
        return Arrays\usort($array, $callback);
    }
}
