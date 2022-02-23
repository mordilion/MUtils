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

class Bit
{
    public static function isset(int $set, int $bit): bool
    {
        return Bit\bit_isset($set, $bit);
    }

    public static function set(int $set, int $bit): int
    {
        return Bit\bit_set($set, $bit);
    }

    public static function unset(int $set, int $bit): int
    {
        return Bit\bit_unset($set, $bit);
    }
}
