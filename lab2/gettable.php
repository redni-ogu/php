<?php declare(strict_types=1); ?>

<?php
/**
 * Печатает HTML-таблицу умножения размера rows × cols с цветом заголовков color.
 *
 * В первой строке и первом столбце выводятся заголовки, ячейки содержат произведения индексов.
 * Возвращает общее число вызовов функции (локальная статическая переменная).
 *
 * @param int $cols Количество столбцов (1..10).
 * @param int $rows Количество строк (1..10).
 * @param string $color Цвет фона заголовков (CSS-значение, например '#ffe680' или 'lightyellow').
 * @return int Количество вызовов функции с момента первой загрузки.
 */
function getTable(int $cols = 5, int $rows = 5, string $color = '#ffe680'): int
{
    static $count = 0;
    $count++;

    // Нормализация границ
    $cols = max(1, min(10, $cols));
    $rows = max(1, min(10, $rows));

    echo '<table>' . PHP_EOL;

    echo '  <tr>' . PHP_EOL;
    echo '    <th style="text-align:center;background-color:' . htmlspecialchars($color, ENT_QUOTES, 'UTF-8') . ';">&times;</th>' . PHP_EOL;
    for ($c = 1; $c <= $cols; $c++) {
        echo '    <th style="text-align:center;background-color:' . htmlspecialchars($color, ENT_QUOTES, 'UTF-8') . ';">' . $c . '</th>' . PHP_EOL;
    }
    echo '  </tr>' . PHP_EOL;

    for ($r = 1; $r <= $rows; $r++) {
        echo '  <tr>' . PHP_EOL;
        echo '    <th style="text-align:center;background-color:' . htmlspecialchars($color, ENT_QUOTES, 'UTF-8') . ';">' . $r . '</th>' . PHP_EOL;

        for ($c = 1; $c <= $cols; $c++) {
            echo '    <td>' . ($r * $c) . '</td>' . PHP_EOL;
        }
        echo '  </tr>' . PHP_EOL;
    }

    echo '</table>' . PHP_EOL;

    return $count;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Таблица умножения</title>
<style>
table {
  border: 2px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 10px;
  border: 1px solid black;
}
th {
  background-color: yellow;
}
</style>
</head>
<body>
<h1>Таблица умножения</h1>

<?php
// ЗАДАНИЕ 3 и 5: разные варианты вызова
$total = 0;

$total = getTable();
echo '<hr>';

$total = getTable(7);
echo '<hr>';

$total = getTable(4, 6);
echo '<hr>';

$total = getTable(10, 10, 'lightblue');
echo '<hr>';

echo '<p>Всего вызовов getTable(): ' . $total . '</p>';
?>

</body>
</html>
