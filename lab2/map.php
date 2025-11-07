<?php declare(strict_types=1); ?>

<?php
/**
 * Применяет коллбэк к каждому элементу массива и возвращает новый массив результатов.
 *
 * @param array<int, int> $items Входной массив чисел.
 * @param callable(int): int $callback Коллбэк, принимающий число и возвращающий число.
 * @return array<int, int> Результирующий массив после применения коллбэка.
 */
function map(array $items, callable $callback): array
{
    $result = [];
    foreach ($items as $i => $value) {
        $result[$i] = $callback($value);
    }
    return $result;
}

$numbers = [1, 2, 3, 4, 5];
$squares = map($numbers, fn (int $n): int => $n * $n);

echo '<script>';
echo 'console.log("squares =", ' . json_encode($squares, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) . ');';
echo '</script>';

echo '<pre>squares = ' . implode(', ', $squares) . "</pre>\n";
