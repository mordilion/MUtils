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
     * @param object|null $instance
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public static function getReflectionClass($instance): ?ReflectionClass
    {
        return Objects\get_reflection_class($instance);
    }

    /**
     * @param object|null $instance
     * @param string      $name
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public static function getReflectionMethod($instance, string $name): ?ReflectionMethod
    {
        return Objects\get_reflection_method($instance, $name);
    }

    /**
     * @param object|null $instance
     * @param string      $name
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public static function getReflectionProperty($instance, string $name): ?ReflectionProperty
    {
        return Objects\get_reflection_property($instance, $name);
    }
}
