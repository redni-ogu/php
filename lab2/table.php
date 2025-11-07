<?php declare(strict_types=1); ?>

<?php
/**
 * Возвращает HTML-разметку таблицы умножения размером rows × cols.
 *
 * Первая строка (заголовки столбцов) и первый столбец (заголовки строк) выделяются стилем,
 * значения в ячейках — произведение индексов строки и столбца. Использует вложенные циклы for.
 *
 * @param int $rows Количество строк (1..10).
 * @param int $cols Количество столбцов (1..10).
 * @return string Сформированная HTML-таблица.
 */
function renderMultiplicationTable(int $rows, int $cols): string
{
    // Нормализуем границы на случай некорректного ввода
    $rows = max(1, min(10, $rows));
    $cols = max(1, min(10, $cols));

    $html = '<table>' . PHP_EOL;

    $html .= '  <tr>' . PHP_EOL;
    $html .= '    <th style="text-align:center;background-color:#ffe680;">&times;</th>' . PHP_EOL;
    for ($c = 1; $c <= $cols; $c++) {
        $html .= '    <th style="text-align:center;background-color:#ffe680;">' . $c . '</th>' . PHP_EOL;
    }
    $html .= '  </tr>' . PHP_EOL;


    for ($r = 1; $r <= $rows; $r++) {
        $html .= '  <tr>' . PHP_EOL;

        // Первый столб
        $html .= '    <th style="text-align:center;background-color:#ffe680;">' . $r . '</th>' . PHP_EOL;

        // Ячейки данных
        for ($c = 1; $c <= $cols; $c++) {
            $product = $r * $c;
            $html .= '    <td>' . $product . '</td>' . PHP_EOL;
        }

        $html .= '  </tr>' . PHP_EOL;
    }

    $html .= '</table>' . PHP_EOL;

    return $html;
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
th,
td {
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

$cols = 7;
$rows = 6;

echo renderMultiplicationTable($rows, $cols);
?>
</body>
</html>
