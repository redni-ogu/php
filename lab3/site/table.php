<?php declare(strict_types=1); ?>
<?php
require_once __DIR__ . '/inc/lib.inc.php';
require_once __DIR__ . '/inc/data.inc.php';

$defaultCols   = $defaultCols   ?? 5;
$defaultRows   = $defaultRows   ?? 5;
$defaultColor  = $defaultColor  ?? '#ffe680';

// Читаем входные параметры из формы (строки -> валидация -> ints/строка)
$cols  = isset($_GET['cols'])  ? (int) $_GET['cols']  : $defaultCols;
$rows  = isset($_GET['rows'])  ? (int) $_GET['rows']  : $defaultRows;
$color = isset($_GET['color']) ? (string) $_GET['color'] : $defaultColor;

// Нормализация: ограничим 1..10 для размеров
$cols = max(1, min(10, $cols));
$rows = max(1, min(10, $rows));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица умножения</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <?php include __DIR__ . '/inc/top.inc.php'; ?>
</header>

<section>
    <h1>Таблица умножения</h1>

    <form action="" method="get">
        <label>Количество колонок:</label><br>
        <input name="cols" type="number" min="1" max="10" value="<?= htmlspecialchars((string)$cols, ENT_QUOTES, 'UTF-8') ?>"><br>

        <label>Количество строк:</label><br>
        <input name="rows" type="number" min="1" max="10" value="<?= htmlspecialchars((string)$rows, ENT_QUOTES, 'UTF-8') ?>"><br>

        <label>Цвет:</label><br>
        <input name="color" type="color" value="<?= htmlspecialchars($color, ENT_QUOTES, 'UTF-8') ?>" list="listColors">
        <datalist id="listColors">
            <option>#ff0000</option>
            <option>#00ff00</option>
            <option>#0000ff</option>
        </datalist>
        <br><br>
        <input type="submit" value="Создать">
    </form>

    <br>
    <!-- Таблица -->
    <?php getTable($cols, $rows, $color); ?>
    <!-- /Таблица -->
</section>

<nav>
    <h2>Навигация по сайту</h2>
    <?php include __DIR__ . '/inc/menu.inc.php'; ?>
</nav>

<footer>
    <?php include __DIR__ . '/inc/bottom.inc.php'; ?>
</footer>
</body>
</html>
