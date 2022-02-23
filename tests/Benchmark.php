<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

// arsort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    arsort($array);
}
echo 'arsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\arsort($array);
}
echo 'MUtils\Sort\arsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// asort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    asort($array);
}
echo 'asort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\asort($array);
}
echo 'MUtils\Sort\asort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// krsort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    krsort($array);
}
echo 'krsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\krsort($array);
}
echo 'MUtils\Sort\krsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// ksort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    ksort($array);
}
echo 'krsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\ksort($array);
}
echo 'MUtils\Sort\ksort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// natcasesort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    natcasesort($array);
}
echo 'natcasesort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\natcasesort($array);
}
echo 'MUtils\Sort\natcasesort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// natsort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    natsort($array);
}
echo 'natsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\natsort($array);
}
echo 'MUtils\Sort\natsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// rsort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    rsort($array);
}
echo 'rsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\rsort($array);
}
echo 'MUtils\Sort\rsort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// sort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    sort($array);
}
echo 'sort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\sort($array);
}
echo 'MUtils\Sort\sort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// uasort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    uasort($array, static function ($left, $right) {
        return $left <=> $right;
    });
}
echo 'uasort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\uasort($array, static function ($left, $right) {
        return $left <=> $right;
    });
}
echo 'MUtils\Sort\uasort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// uksort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    uksort($array, static function ($left, $right) {
        return $left <=> $right;
    });
}
echo 'uksort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\uksort($array, static function ($left, $right) {
        return $left <=> $right;
    });
}
echo 'MUtils\Sort\uksort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

echo PHP_EOL;

// usort
$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    usort($array, static function ($left, $right) {
        return $left <=> $right;
    });
}
echo 'usort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;

$start = microtime(true);
$array = range(0, 100);
for ($i = 0; $i < 1000; $i++) {
    \MUtils\Sort\usort($array, static function ($left, $right) {
        return $left <=> $right;
    });
}
echo 'MUtils\Sort\usort :: ' . (microtime(true) - $start) . ' seconds' . PHP_EOL;
