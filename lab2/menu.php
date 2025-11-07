<?php declare(strict_types=1); ?>

<?php
/**
 * Возвращает массив элементов меню слева.
 *
 * Каждый элемент — ассоциативный массив вида:
 * ['link' => string, 'href' => string].
 *
 * @return array<int, array{link:string, href:string}> Список пунктов меню.
 */
function getLeftMenu(): array
{
    return [
        ['link' => 'Домой',               'href' => 'index.php'],
        ['link' => 'О нас',               'href' => 'about.php'],
        ['link' => 'Контакты',            'href' => 'contact.php'],
        ['link' => 'Таблица умножения',   'href' => 'table.php'],
        ['link' => 'Калькулятор',         'href' => 'calc.php'],
    ];
}
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
</style>
</head>
<body>
<h1>Меню</h1>
<nav>
  <ul class="menu">
    <?php
    /**
     * Отрисовывает вертикальное меню по массиву элементов.
     *
     * @param array<int, array{link:string, href:string}> $items Элементы меню.
     * @return void Печатает список <li><a></a></li>.
     */
    function renderMenu(array $items): void
    {
        foreach ($items as $item) {
            $text = htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8');
            $href = htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8');
            echo "<li><a href='{$href}'>{$text}</a></li>";
        }
    }

    $leftMenu = getLeftMenu();
    renderMenu($leftMenu);
    ?>
  </ul>
</nav>
</body>
</html>
