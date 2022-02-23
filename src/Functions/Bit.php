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

namespace MUtils\Bit;

function bit_isset(int $set, int $bit): bool
{
    return ($set & $bit) === $bit;
}

function bit_set(int $set, int $bit): int
{
    return $set | $bit;
}

function bit_unset(int $set, int $bit): int
{
    return $set & ~$bit;
}
