# MUtils — CLAUDE.md

PHP utility library providing helpful functions and PHP 8.0+ backports for older PHP versions. Published on Packagist as `mordilion/mutils`.

## Hard Rules (violations cause bugs)

- Follow all applicable rules and rule precedence.
- Ask targeted questions if outcomes or constraints are unclear.
- Validate all external input before use (type, format, bounds).
- Never log or store secrets; redact sensitive values in logs.
- Use code library patterns instead of inventing new ones.
- Do not introduce fixed versions; read from project config files.
- Prefer smallest change that satisfies requirements.
- Keep outputs concise and unambiguous across AI tools.

---

## Self-Maintenance — Keep CLAUDE.md & Memory Up to Date

**IMPORTANT:** This CLAUDE.md is a living document. It MUST be updated as the project evolves.

### Update CLAUDE.md when:
- New tech stack is added (e.g. new framework, new database)
- New architecture decisions are made
- New conventions are established (coding rules, naming, etc.)
- New modules/features change the project scope
- Build/deploy commands change
- New directories or structural changes are introduced

---

## Workflow & Quality Assurance

### Planning
- For tasks with 3+ steps or architecture decisions: use Plan Mode before writing code.
- If an implementation is going in the wrong direction: stop immediately and re-plan — don't push through.
- Clarify specifications upfront to reduce ambiguity.

### Verification
- Never complete a task without verification: run tests, check logs, demonstrate correctness.
- For relevant changes: verify diff against previous behavior.
- Simple fixes don't need elaborate verification — effort proportional to complexity.

### Bug Fixing
- On bug reports: analyze and fix independently — use logs, error messages, and tests as starting points.
- Find the root cause. No temporary workarounds. Don't expect hand-holding from the user.
- Fix failing CI tests independently.

### Core Principles
- **Simplicity First:** Every change as simple as possible. Touch minimal code.
- **Minimal Impact:** Only change what's necessary. Don't introduce new bugs.
- **Root Cause:** Find causes, don't treat symptoms.

---

## Project Overview

| Layer | Stack | Directory |
|-------|-------|-----------|
| Library | PHP >=7.1 / >=8.0 | `src/`, `src/Functions/` |
| Tests | PHPUnit ^9.5 | `tests/` |
| Static Analysis | Psalm ^4.20 | `psalm.xml` |

### Architecture

- **Dual API:** Each module provides functional (`MUtils\Arrays\sort()`) and OOP (`MUtils\Arrays::sort()`) interfaces
- **Version-aware:** Functions detect PHP version and use native implementations (8.0+) or custom backports (7.1+)
- **Modules:** Arrays, Strings, Bits, Objects
- **Autoloading:** PSR-4 for classes, `autoload.files` for function files in `composer.json`

### Directory Structure

```
src/
├── Arrays.php, Bits.php, Objects.php, Strings.php    # OOP facades (static methods)
└── Functions/
    ├── Arrays.php    # Array sorting (stable), grouping, prefix ops, move
    ├── Bits.php      # Bitwise set/isset/unset
    ├── Objects.php   # Reflection with inheritance search
    └── Strings.php   # str_contains/starts_with/ends_with backports
tests/
├── ArraysTest.php, BitsTest.php, ObjectsTest.php, StringsTest.php
└── Benchmark.php
```

---

## Quick Start

```bash
# Setup
composer install

# Run tests
vendor/bin/phpunit

# Static analysis
vendor/bin/psalm
```

---

## Language & Locale

- **Code Language:** English (variables, functions, types)
- No UI (library only)

---

## Conventions

- `declare(strict_types=1)` in all files
- PSR-4 autoloading under `MUtils\` namespace
- Function implementations in `src/Functions/`, OOP wrappers in `src/`
- Commit messages: lowercase, descriptive, brief (e.g. "add new function array_move_element")

---

## Build & Verification

```bash
# Static Analysis
vendor/bin/psalm

# Tests
vendor/bin/phpunit
```

---

## Change Guidelines

1. **New Utility Function:** Add implementation in `src/Functions/<Module>.php`, add static wrapper in `src/<Module>.php`, add tests in `tests/<Module>Test.php`
2. **New Module:** Create `src/Functions/<Name>.php` + `src/<Name>.php`, register function file in `composer.json` `autoload.files`, add test file
3. **PHP Version Backport:** Use `version_compare(PHP_VERSION, '8.0.0', '>=')` pattern — native call for 8.0+, custom implementation for older versions
