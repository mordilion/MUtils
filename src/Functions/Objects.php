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
use ReflectionMethod;
use ReflectionProperty;

/**
 * @param object|null $instance
 *
 * @throws InvalidArgumentException
 */
function get_reflection_class($instance): ?ReflectionClass
{
    if (!$instance) {
        return null;
    }

    if (!is_object($instance)) {
        throw new InvalidArgumentException('$instance must be an object or null');
    }

    if ($instance instanceof ReflectionClass) {
        return $instance;
    }

    return new ReflectionClass($instance);
}

/**
 * @param object|null $instance
 * @param string      $name
 */
function get_reflection_method($instance, string $name): ?ReflectionMethod
{
    $reflectionClass = get_reflection_class($instance);

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
 * @param object|null $instance
 * @param string      $name
 */
function get_reflection_property($instance, string $name): ?ReflectionProperty
{
    $reflectionClass = get_reflection_class($instance);

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
