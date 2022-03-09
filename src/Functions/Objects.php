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

namespace MUtils\Objects;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

/**
 * @param string|object|null $objectOrClass
 *
 * @throws InvalidArgumentException|ReflectionException
 */
function get_reflection_class($objectOrClass): ?ReflectionClass
{
    if (!$objectOrClass) {
        return null;
    }

    if (!is_object($objectOrClass) && !is_string($objectOrClass)) {
        throw new InvalidArgumentException('$objectOrClass must be an object, class or null');
    }

    if ($objectOrClass instanceof ReflectionClass) {
        return $objectOrClass;
    }

    return new ReflectionClass($objectOrClass);
}

/**
 * @param string|object|null $objectOrClass
 * @param string             $name
 */
function get_reflection_method($objectOrClass, string $name): ?ReflectionMethod
{
    $reflectionClass = get_reflection_class($objectOrClass);

    if (!$reflectionClass) {
        return null;
    }

    do {
        if ($reflectionClass->hasMethod($name)) {
            return $reflectionClass->getMethod($name);
        }
    } while ($reflectionClass = $reflectionClass->getParentClass());

    return null;
}

/**
 * @param string|object|null $objectOrClass
 * @param string             $name
 */
function get_reflection_property($objectOrClass, string $name): ?ReflectionProperty
{
    $reflectionClass = get_reflection_class($objectOrClass);

    if (!$reflectionClass) {
        return null;
    }

    do {
        if ($reflectionClass->hasProperty($name)) {
            return $reflectionClass->getProperty($name);
        }
    } while ($reflectionClass = $reflectionClass->getParentClass());

    return null;
}
