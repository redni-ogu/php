<?php declare(strict_types=1); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Цикл for</title>
</head>
<body>
<h1>Цикл for</h1>
<?php
/**
 * Выводит нечётные числа в диапазоне [1, 50] по одному в строке.
 *
 * @return void Ничего не возвращает, печатает в поток вывода.
 */
function printOddNumbers1to50(): void
{
    // Перебор только нечётных: старт 1, шаг 2
    for ($i = 1; $i <= 50; $i += 2) {
        echo $i . '<br>';
    }
}

printOddNumbers1to50();
?>
</body>
</html>
