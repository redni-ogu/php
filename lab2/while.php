<?php declare(strict_types=1); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Цикл while</title>
</head>
<body>
<h1>Цикл while</h1>
<?php
/**
 * Выводит каждый символ переданной строки в отдельной строке HTML.
 *
 * Использует mb_str_split для корректной обработки многобайтовых символов UTF-8.
 *
 * @param string $text Исходная строка для посимвольного вывода.
 * @return void Печатает символы с <br> между ними.
 */
function printCharsVertical(string $text): void
{
    // Разбиваем строку на массив
    $chars = mb_str_split($text, 1, 'UTF-8');

    $i = 0;
    $len = count($chars);
    while ($i < $len) {
        echo htmlspecialchars($chars[$i], ENT_QUOTES, 'UTF-8') . '<br>';
        $i++;
    }
}

$var = 'ПРИВЕТ';
printCharsVertical($var);
?>
</body>
</html>
