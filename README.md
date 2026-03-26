# MUtils

[![Latest Version](https://img.shields.io/packagist/v/mordilion/mutils)](https://packagist.org/packages/mordilion/mutils)
[![PHP Version](https://img.shields.io/packagist/php-v/mordilion/mutils)](https://packagist.org/packages/mordilion/mutils)
[![License](https://img.shields.io/packagist/l/mordilion/mutils)](LICENSE)

A PHP utility library providing helpful array, string, bitwise, and reflection functions — plus stable-sort and string backports so PHP 7.1+ projects can use PHP 8.0+ behaviour today.

**Dual API:** Every function is available as a namespaced function (`MUtils\Arrays\sort()`) and as a static method (`MUtils\Arrays::sort()`). Use whichever style fits your codebase.

## Table of Contents

- [Installation](#installation)
- [Quick Start](#quick-start)
- [API Reference: Arrays](#arrays)
  - [Sorting (PHP 8.0+ Backports)](#sorting-php-80-backports)
  - [Utility Functions](#utility-functions)
- [API Reference: Bits](#bits)
- [API Reference: Strings](#strings)
- [API Reference: Objects](#objects)
- [PHP Version Compatibility](#php-version-compatibility)
- [Development](#development)
- [License](#license)

## Installation

```bash
composer require mordilion/mutils
```

## Quick Start

```php
// Stable sorting (on PHP < 8.0: guaranteed stable, on PHP 8.0+: native pass-through)
$array = [3 => 'b', 1 => 'a', 2 => 'a'];
MUtils\Arrays\asort($array);

// String checks (PHP 8.0+ backport)
MUtils\Strings\str_starts_with('Hello World', 'Hello'); // true

// Bitwise operations
$flags = MUtils\Bits\bit_set(0, 4);    // 4
MUtils\Bits\bit_isset($flags, 4);      // true

// Reflection with inheritance traversal
$method = MUtils\Objects\get_reflection_method($object, 'parentMethod');
```

---

## Arrays

Array sorting with stable-sort guarantees (PHP 8.0+ backport) and utility functions for grouping, moving, and prefix operations.

### Sorting (PHP 8.0+ Backports)

On PHP 8.0+ these pass through to the native implementation. On PHP < 8.0 they use a [Schwartzian transform](https://en.wikipedia.org/wiki/Schwartzian_transform) to guarantee stable sorting — equal elements retain their original order.

> **Note:** The backport implementation is slower than native sorting. On PHP 8.0+ there is no performance penalty.

| Function | Static Method | Description |
|---|---|---|
| `sort(array &$array, int $flags = SORT_REGULAR): bool` | `Arrays::sort()` | Sort array by values |
| `rsort(array &$array, int $flags = SORT_REGULAR): bool` | `Arrays::reverseSort()` | Reverse sort by values |
| `asort(array &$array, int $flags = SORT_REGULAR): bool` | `Arrays::associativeSort()` | Sort maintaining key association |
| `arsort(array &$array, int $flags = SORT_REGULAR): bool` | `Arrays::associativeReverseSort()` | Reverse sort maintaining key association |
| `ksort(array &$array, int $flags = SORT_REGULAR): bool` | `Arrays::keySort()` | Sort by keys |
| `krsort(array &$array, int $flags = SORT_REGULAR): bool` | `Arrays::keyReverseSort()` | Reverse sort by keys |
| `natsort(array &$array): bool` | `Arrays::naturalSort()` | Natural order sort |
| `natcasesort(array &$array): bool` | `Arrays::naturalCaseInsensitiveSort()` | Case-insensitive natural order sort |
| `usort(array &$array, callable $callback): bool` | `Arrays::userSort()` | User-defined sort |
| `uasort(array &$array, callable $callback): bool` | `Arrays::userAssociativeSort()` | User-defined sort maintaining key association |
| `uksort(array &$array, callable $callback): bool` | `Arrays::userKeySort()` | User-defined sort by keys |

```php
$array = [128, 2, 16, 64, 8, 1, 32];

MUtils\Arrays\sort($array);
// [1, 2, 8, 16, 32, 64, 128]

// Or using the OOP API:
MUtils\Arrays::sort($array);
```

### Utility Functions

#### `array_group_by(array $array, bool $preserveKeys, $column, ...$columns): array`

**Static:** `Arrays::groupBy()`

Groups array elements by a column key, object property, or callable. Pass additional `$column` arguments for nested grouping.

The `$column` parameter accepts:
- `string` or `int` — array key or object property name
- `callable` — receives the element, returns the group key

```php
$data = [
    ['dept' => 'engineering', 'role' => 'backend',  'name' => 'Alice'],
    ['dept' => 'engineering', 'role' => 'frontend', 'name' => 'Bob'],
    ['dept' => 'design',      'role' => 'ux',       'name' => 'Carol'],
];

// Simple grouping
$byDept = MUtils\Arrays\array_group_by($data, false, 'dept');
// ['engineering' => [...], 'design' => [...]]

// Nested grouping
$byDeptAndRole = MUtils\Arrays\array_group_by($data, false, 'dept', 'role');
// ['engineering' => ['backend' => [...], 'frontend' => [...]], 'design' => ['ux' => [...]]]

// With preserved keys
$byDept = MUtils\Arrays\array_group_by($data, true, 'dept');
```

**Throws:** `InvalidArgumentException` if `$column` is not a string, integer, float, or callable.

---

#### `array_move_element(array &$array, int $fromIndex, int $toIndex): void`

**Static:** `Arrays::moveElement()`

Moves an element from one position to another within an indexed array.

```php
$array = ['a', 'b', 'c', 'd'];

MUtils\Arrays\array_move_element($array, 3, 1);
// ['a', 'd', 'b', 'c']
```

**Throws:** `OutOfBoundsException` if either index is out of range or the array is empty.

---

#### `array_prefix_add(array $array, string $prefix, int $options = ARRAY_PREFIX_KEY): array`

**Static:** `Arrays::addPrefix()`

Adds a prefix to array keys or values.

```php
$array = ['name' => 'Alice', 'role' => 'dev'];

// Prefix keys (default)
MUtils\Arrays\array_prefix_add($array, 'user_');
// ['user_name' => 'Alice', 'user_role' => 'dev']

// Prefix values
MUtils\Arrays\array_prefix_add($array, 'prefix_', ARRAY_PREFIX_VALUE);
// ['name' => 'prefix_Alice', 'role' => 'prefix_dev']
```

---

#### `array_prefix_remove(array $array, string $prefix, int $options = ARRAY_PREFIX_KEY): array`

**Static:** `Arrays::removePrefix()`

Removes a prefix from array keys or values. Keys/values that do not start with the prefix are left unchanged.

```php
$array = ['user_name' => 'Alice', 'user_role' => 'dev'];

MUtils\Arrays\array_prefix_remove($array, 'user_');
// ['name' => 'Alice', 'role' => 'dev']
```

---

#### Prefix Constants

| Constant | Value | Effect |
|---|---|---|
| `ARRAY_PREFIX_KEY` | `1` | Apply prefix operation to keys (default) |
| `ARRAY_PREFIX_VALUE` | `2` | Apply prefix operation to values |

Since these are bitmask values, you can combine them: `ARRAY_PREFIX_KEY | ARRAY_PREFIX_VALUE` (= `3`) applies the operation to both keys and values.

---

#### `array_compare_flags($a, $b, int $flags): int`

**Static:** `Arrays::compareFlags()`

Compares two values using PHP sort flag semantics. Primarily used internally by the stable-sort backport, but available as a public API.

Supported flags: `SORT_REGULAR`, `SORT_NUMERIC`, `SORT_STRING`, `SORT_STRING | SORT_FLAG_CASE`, `SORT_NATURAL`, `SORT_NATURAL | SORT_FLAG_CASE`, `SORT_LOCALE_STRING`.

```php
MUtils\Arrays\array_compare_flags('apple', 'Banana', SORT_STRING | SORT_FLAG_CASE);
// < 0 (case-insensitive string comparison)
```

---

## Bits

Bitwise utility functions for working with sets of bit flags.

| Function | Static Method | Description |
|---|---|---|
| `bit_set(int $set, int $bit): int` | `Bits::set()` | Set a bit in the given integer |
| `bit_isset(int $set, int $bit): bool` | `Bits::isset()` | Check if a bit is set |
| `bit_unset(int $set, int $bit): int` | `Bits::unset()` | Unset a bit in the given integer |

```php
$flags = 0;

$flags = MUtils\Bits\bit_set($flags, 4);     // 4  (binary: 100)
$flags = MUtils\Bits\bit_set($flags, 8);     // 12 (binary: 1100)

MUtils\Bits\bit_isset($flags, 4);            // true
MUtils\Bits\bit_isset($flags, 2);            // false

$flags = MUtils\Bits\bit_unset($flags, 4);   // 8  (binary: 1000)
```

---

## Strings

PHP 8.0+ string function backports. On PHP 8.0+ these pass through to the native implementation. On PHP < 8.0 they use `mb_*` functions as the implementation.

> **Note:** On PHP < 8.0, the `mbstring` extension is required.

| Function | Static Method | Description |
|---|---|---|
| `str_contains(string $haystack, string $needle): bool` | `Strings::contains()` | Check if string contains substring |
| `str_starts_with(string $haystack, string $needle): bool` | `Strings::startsWith()` | Check if string starts with substring |
| `str_ends_with(string $haystack, string $needle): bool` | `Strings::endsWith()` | Check if string ends with substring |

```php
$text = 'Hello World';

MUtils\Strings\str_contains($text, 'World');      // true
MUtils\Strings\str_starts_with($text, 'Hello');   // true
MUtils\Strings\str_ends_with($text, 'World');     // true

// Or using the OOP API:
MUtils\Strings::contains($text, 'World');          // true
```

---

## Objects

Reflection utility functions that traverse the class inheritance chain. Unlike PHP's built-in `ReflectionClass::getMethod()` and `ReflectionClass::getProperty()`, these functions walk up through parent classes to find methods and properties defined anywhere in the hierarchy.

| Function | Static Method | Description |
|---|---|---|
| `get_reflection_class($objectOrClass): ?ReflectionClass` | `Objects::getReflectionClass()` | Get ReflectionClass from object, class name, or ReflectionClass |
| `get_reflection_method($objectOrClass, string $name): ?ReflectionMethod` | `Objects::getReflectionMethod()` | Find method in class or its parents |
| `get_reflection_property($objectOrClass, string $name): ?ReflectionProperty` | `Objects::getReflectionProperty()` | Find property in class or its parents |

All functions accept an object instance, a class name string, or a `ReflectionClass` instance as the first parameter. Returns `null` if the target is not found (or if `null` is passed).

**Throws:** `InvalidArgumentException` if the first argument is not an object, string, or null. `get_reflection_class` may also throw `ReflectionException` if the class does not exist.

```php
class ParentClass {
    protected string $secret = 'hidden';

    protected function greet(): string {
        return 'hello';
    }
}

class ChildClass extends ParentClass {}

$child = new ChildClass();

// Finds the method defined in ParentClass
$method = MUtils\Objects\get_reflection_method($child, 'greet');
$method->invoke($child); // 'hello'

// Finds the property defined in ParentClass
$prop = MUtils\Objects\get_reflection_property($child, 'secret');
$prop->setAccessible(true);
$prop->getValue($child); // 'hidden'
```

---

## PHP Version Compatibility

| Feature | PHP >= 8.0 | PHP 7.1 - 7.4 |
|---|---|---|
| Stable sorting | Native pass-through | Schwartzian transform (slower) |
| String functions (`str_contains`, etc.) | Native pass-through | `mb_*` implementation (requires `mbstring`) |
| Utility functions (bits, objects, arrays) | Full support | Full support |

## Development

```bash
# Install dependencies
composer install

# Run tests
vendor/bin/phpunit

# Static analysis
vendor/bin/psalm
```

## License

MIT
