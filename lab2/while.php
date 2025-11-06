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
    // Разбиваем строку на массив символов с учетом UTF-8
    // Если mb_str_split недоступна, можно использовать mb_substr в цикле (альтернатива).
    $chars = mb_str_split($text, 1, 'UTF-8'); // Требуется PHP 7.4+ и расширение mbstring [web:43][web:41]

    $i = 0;
    $len = count($chars);
    while ($i < $len) {
        echo htmlspecialchars($chars[$i], ENT_QUOTES, 'UTF-8') . '<br>'; // Для HTML переноса используем <br> [web:30][web:50][web:44]
        $i++;
    }
}

// ЗАДАНИЕ: $var = 'ПРИВЕТ' и вывод по одному символу в столбик
$var = 'ПРИВЕТ';
printCharsVertical($var);
?>
</body>
</html>
