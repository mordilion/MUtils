# README Overhaul Design Spec

## Goal

Rewrite the MUtils README.md to serve both newcomers (installation, quick start) and existing users (complete API reference). Single file, English, all public APIs documented.

## Target Audience

- Developers discovering the library on Packagist/GitHub
- Developers already using the library who need a function reference

## Structure

1. **Header** - Package name, Packagist/PHP/License badges, one-paragraph description, dual-API note
2. **Table of Contents** - Linked section overview for navigation
3. **Installation** - `composer require` one-liner
4. **Quick Start** - One example per module (Arrays, Strings, Bits, Objects)
5. **API Reference: Arrays**
   - Sorting functions as compact table (all PHP 8.0+ backports, same signature pattern)
   - Utility functions with individual detail sections: `array_group_by`, `array_move_element`, `array_prefix_add`, `array_prefix_remove`, `array_compare_flags`
   - `array_stretch_information` mentioned briefly in sorting backport explanation (internal helper, not a primary API)
   - Constants table: `ARRAY_PREFIX_KEY`, `ARRAY_PREFIX_VALUE`
   - Exception behavior documented where applicable (e.g., `OutOfBoundsException` in `array_move_element`)
6. **API Reference: Bits** - Table + example
7. **API Reference: Strings** - Table + example, note that `mbstring` extension is required on PHP < 8.0
8. **API Reference: Objects** - Inheritance traversal explanation + table, exception behavior documented
9. **PHP Version Compatibility** - Matrix table (feature x PHP version), note `mbstring` dependency for PHP < 8.0
10. **Development** - `composer install`, `vendor/bin/phpunit`, `vendor/bin/psalm`
11. **License** - MIT

## Design Decisions

- **Sorting functions as table, not individual sections**: They all follow the same pattern (`&$array, $flags`) and the only difference is sort direction/mode. A table is scannable and avoids repetition.
- **Utility functions get detail sections**: These have varying signatures and non-obvious behavior (e.g., nested grouping, prefix constants) that benefit from examples.
- **Both function and OOP names shown**: Every entry shows the namespaced function and the corresponding static method name so users can pick their preferred style.
- **No separate files**: Project is small enough (~25 functions) that a single README stays manageable. Table of contents provides navigation.
- **Badges**: Standard Packagist badges for discoverability and trust.

## Content Notes

- Sorting backport section explains the Schwartzian transform approach for PHP < 8.0
- String backport section notes that `mb_*` functions are the implementation on PHP < 8.0 (not a fallback — they ARE the backport), meaning `mbstring` extension is a de facto requirement
- Objects section explains parent-class traversal behavior
- All examples use the functional API (shorter), with OOP equivalent noted in tables
