<?php declare(strict_types=1);
require_once __DIR__ . '/inc/lib.inc.php';
require_once __DIR__ . '/inc/data.inc.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт нашей школы</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Верхняя часть страницы -->
<?php include_once __DIR__ . '/inc/top.inc.php'; ?>
<!-- Навигация -->
<?php include_once __DIR__ . '/inc/menu.inc.php'; ?>
<!-- Область основного контента -->
<?php include_once __DIR__ . '/inc/index.inc.php'; ?>
<!-- Нижняя часть страницы -->
<?php include_once __DIR__ . '/inc/bottom.inc.php'; ?>
</body>
</html>
