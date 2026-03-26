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

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

class Objects
{
    /**
     * @param string|object|null $objectOrClass
     *
     * @throws InvalidArgumentException|ReflectionException
     */
    public static function getReflectionClass($objectOrClass): ?ReflectionClass
    {
        return Objects\get_reflection_class($objectOrClass);
    }

    /**
     * @param string|object|null $objectOrClass
     *
     * @throws InvalidArgumentException
     */
    public static function getReflectionMethod($objectOrClass, string $name): ?ReflectionMethod
    {
        return Objects\get_reflection_method($objectOrClass, $name);
    }

    /**
     * @param string|object|null $objectOrClass
     *
     * @throws InvalidArgumentException
     */
    public static function getReflectionProperty($objectOrClass, string $name): ?ReflectionProperty
    {
        return Objects\get_reflection_property($objectOrClass, $name);
    }
}
