<?php declare(strict_types=1); ?>

<?php
/**
 * Печатает HTML-меню на основе заданного массива пунктов.
 *
 * При $vertical=true выводится вертикальный список (<ul class="menu">),
 * при $vertical=false добавляется класс horizontal для горизонтального отображения.
 *
 * Элемент массива меню имеет форму ['link' => string, 'href' => string].
 *
 * @param array<int, array{link:string, href:string}> $menu Структура меню.
 * @param bool $vertical Флаг ориентации: true — вертикально, false — горизонтально.
 * @return void
 */
function getMenu(array $menu, bool $vertical = true): void
{
    $ulClass = $vertical ? 'menu' : 'menu horizontal';
    echo '<ul class="' . $ulClass . '">' . PHP_EOL;

    foreach ($menu as $item) {
        $text = htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8');
        $href = htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8');
        echo "  <li><a href='{$href}'>{$text}</a></li>" . PHP_EOL;
    }

    echo '</ul>' . PHP_EOL;
}

// ЗАДАНИЕ 2: структура меню, как в menu.php
$leftMenu = [
    ['link' => 'Домой',               'href' => 'index.php'],
    ['link' => 'О нас',               'href' => 'about.php'],
    ['link' => 'Контакты',            'href' => 'contact.php'],
    ['link' => 'Таблица умножения',   'href' => 'table.php'],
    ['link' => 'Калькулятор',         'href' => 'calc.php'],
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Меню</title>
<style>
.menu {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
.horizontal li {
  display: inline;
  padding: 5px
}
</style>
</head>
<body>
<h1>Меню</h1>

<nav>
<?php
// ЗАДАНИЕ 3: вертикальное меню (один параметр)
getMenu($leftMenu);

// ЗАДАНИЕ 4: горизонтальное меню (второй параметр false)
getMenu($leftMenu, false);
?>
</nav>

</body>
</html>
