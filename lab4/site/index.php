<?php declare(strict_types=1); ?>

<?php
require_once __DIR__ . '/inc/lib.inc.php';
require_once __DIR__ . '/inc/data.inc.php';

// Текущее время
$now  = getdate();                     // массив с текущей датой/временем [web:219][web:207]
$hour = (int) ($now['hours'] ?? 0);    // текущий час 0..23 [web:219][web:223]

// Приветствие по времени суток
if ($hour >= 0 && $hour < 6) {
    $welcome = 'Доброй ночи';
} elseif ($hour >= 6 && $hour < 12) {
    $welcome = 'Доброе утро';
} elseif ($hour >= 12 && $hour < 18) {
    $welcome = 'Добрый день';
} elseif ($hour >= 18 && $hour <= 23) {
    $welcome = 'Добрый вечер';
} else {
    $welcome = 'Доброй ночи';
}

// Инициализация заголовков страницы
$title  = 'Сайт нашей школы';
$header = "$welcome, Гость!";

// Читаем id из GET-параметра, приводим к нижнему регистру и чистим
$id = strtolower(strip_tags(trim($_GET['id'] ?? ''))); // isset/?? защищает от Undefined index [web:315][web:219]

// Меняем заголовки в зависимости от id
switch ($id) {
    case 'about':
        $title  = 'О сайте';
        $header = 'О нашем сайте';
        break;
    case 'contact':
        $title  = 'Контакты';
        $header = 'Обратная связь';
        break;
    case 'table':
        $title  = 'Таблица умножения';
        $header = 'Таблица умножения';
        break;
    case 'calc':
        $title  = 'Он-лайн калькулятор';
        $header = 'Калькулятор';
        break;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <!-- Верхняя часть страницы -->
    <?php include __DIR__ . '/inc/top.inc.php'; ?>
    <!-- Верхняя часть страницы -->
</header>

<section>
    <!-- Заголовок -->
    <h1><?=$header?></h1>
    <!-- Заголовок -->
    <!-- Область основного контента -->
    <?php
    switch ($id) {
        case 'about':
            include __DIR__ . '/about.php';
            break;
        case 'contact':
            include __DIR__ . '/contact.php';
            break;
        case 'table':
            include __DIR__ . '/table.php';
            break;
        case 'calc':
            include __DIR__ . '/calc.php';
            break;
        default:
            include __DIR__ . '/inc/index.inc.php';
    }
    ?>
    <!-- Область основного контента -->
</section>

<nav>
    <h2>Навигация по сайту</h2>
    <?php include __DIR__ . '/inc/menu.inc.php'; ?>
</nav>

<footer>
    <!-- Нижняя часть страницы -->
    <?php
    $year = getdate()['year'] ?? date('Y');  // текущий год [web:219][web:209]
    ?>
    &copy; Супер Мега Веб-мастер, 2000 &ndash; <?=$year?>
    <!-- Нижняя часть страницы -->
</footer>
</body>
</html>
