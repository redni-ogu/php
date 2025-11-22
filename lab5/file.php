<?php declare(strict_types=1); ?>

<?php
/**
 * Имя текстового файла для хранения записей гостевой книги.
 */
const GUESTBOOK_FILE = __DIR__ . '/db/guests.txt';

/**
 * Сохраняет запись пользователя в файл гостевой книги.
 *
 * @param string $firstName Имя.
 * @param string $lastName  Фамилия.
 * @return void
 */
function saveGuest(string $firstName, string $lastName): void
{
    // Фильтрация
    $firstName = htmlspecialchars(strip_tags(trim($firstName)), ENT_QUOTES, 'UTF-8');
    $lastName  = htmlspecialchars(strip_tags(trim($lastName)), ENT_QUOTES, 'UTF-8');

    if ($firstName === '' && $lastName === '') {
        return;
    }

    // Одна строка = один пользователь
    $line = $firstName . ' ' . $lastName . PHP_EOL;

    // Запись в файл с добавлением в конец
    file_put_contents(GUESTBOOK_FILE, $line, FILE_APPEND | LOCK_EX);
}

// ЗАДАНИЕ 1: обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    saveGuest($_POST['fname'] ?? '', $_POST['lname'] ?? '');

    // Перезапрос страницы, чтобы избежать повторной отправки POST
    header('Location: ' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Работа с файлами</title>
</head>
<body>

<h1>Заполните форму</h1>

<form method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8')?>">
    Имя: <input type="text" name="fname"><br>
    Фамилия: <input type="text" name="lname"><br>
    <br>
    <input type="submit" value="Отправить!">
</form>

<?php
// ЗАДАНИЕ 2: вывод содержимого файла
if (file_exists(GUESTBOOK_FILE)) {
    $lines = file(GUESTBOOK_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (!empty($lines)) {
        echo '<h2>Список пользователей</h2>';
        echo '<ol>';
        foreach ($lines as $idx => $line) {
            echo '<li>' . htmlspecialchars($line, ENT_QUOTES, 'UTF-8') . '</li>';
        }
        echo '</ol>';

        $size = filesize(GUESTBOOK_FILE);
        echo '<p>Размер файла: ' . (int)$size . ' байт</p>';
    }
}
?>

</body>
</html>
