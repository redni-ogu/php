<?php declare(strict_types=1);

/**
 * Печатает HTML-таблицу умножения размера rows × cols с цветом заголовков color.
 *
 * @param int $cols Количество столбцов (1..10).
 * @param int $rows Количество строк (1..10).
 * @param string $color Цвет фона заголовков (CSS-значение).
 * @return int Количество вызовов функции (накапливается статически).
 */
function getTable(int $cols = 5, int $rows = 5, string $color = '#ffe680'): int
{
    static $count = 0;
    $count++;

    $cols = max(1, min(10, $cols));
    $rows = max(1, min(10, $rows));

    echo '<table>' . PHP_EOL;
    echo '  <tr>' . PHP_EOL;
    echo '    <th style="text-align:center;background-color:' . htmlspecialchars($color, ENT_QUOTES, 'UTF-8') . ';">&times;</th>' . PHP_EOL;
    for ($c = 1; $c <= $cols; $c++) {
        echo '    <th style="text-align:center;background-color:' . htmlspecialchars($color, ENT_QUOTES, 'UTF-8') . ';">' . $c . '</th>' . PHP_EOL;
    }
    echo '  </tr>' . PHP_EOL;

    for ($r = 1; $r <= $rows; $r++) {
        echo '  <tr>' . PHP_EOL;
        echo '    <th style="text-align:center;background-color:' . htmlspecialchars($color, ENT_QUOTES, 'UTF-8') . ';">' . $r . '</th>' . PHP_EOL;
        for ($c = 1; $c <= $cols; $c++) {
            echo '    <td>' . ($r * $c) . '</td>' . PHP_EOL;
        }
        echo '  </tr>' . PHP_EOL;
    }
    echo '</table>' . PHP_EOL;

    return $count;
}

/**
 * Печатает HTML-меню по структуре $menu.
 *
 * @param array<int, array{link:string, href:string}> $menu Элементы меню.
 * @param bool $vertical true — вертикально, false — горизонтально.
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

/**
 * Рисует таблицу умножения.
 *
 * @param int $cols
 * @param int $rows
 * @param string $color
 * @return void
 */
function drawTable(int $cols, int $rows, string $color): void
{
    getTable($cols, $rows, $color);
}