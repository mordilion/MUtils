# MUtils

MUtils is a collection of useful functions and to provide some PHP 8.0+ features for older PHP versions.

## PHP 8.0+ Features
If you use the functions from this Library, it checks if you are using PHP 8.0+ and use then the internal functions (pass-through).
- Stable Sorting (Slow Performance if it's not pass-through!) - https://wiki.php.net/rfc/stable_sorting
  - _asort, arsort, ksort, krsort, natcasesort, natsort, rsort, sort, uasort, uksort, usort_
- String Functions
  - _str_contains, str_ends_with, str_starts_with_

## Useful Functions
- Bitwise Functions - Some useful functions to work with sets of bits.
  - _bit_set, bit_isset, bit_unset_
- Reflection Functions - Useful functions to get ReflectionClass, ReflectionMethod and ReflectionProperty on inheritance
  - _get_reflection_class, get_reflection_method, get_reflection_property_

## Examples
### Use of sort functions
```php
<?php

$array = [128, 2, 16, 64, 8, 1, 32];

// or MUtils\Sort::userAssociativeSort()
MUtils\Sort\uasort($array, static function ($left, $right) {
    return $left <=> $right;
})
```

### Use of string functions 
```php
<?php

// or MUtils\Strings::startsWith()
if (MUtils\Strings\str_starts_with('Some Text', 'Some')) {
    // ...
}
```

### Use of bit functions
```php
<?php

// or MUtils\Bit::isset()
if (MUtils\Bit\bit_isset(12, 4)) {
    // ...
}
```

### Use of reflection functions
```php
<?php

// or MUtils\Objects::getReflectionMethod()
$instance = new Something();
$method = MUtils\Objects\get_reflection_method($instance, 'foo');
if ($method) {
    $method->invoke($instance, 'arg');
    // ...
}
```
