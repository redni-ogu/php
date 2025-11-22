<?php declare(strict_types=1); ?>

<?php
/**
 * Выводит все определённые константы, сгруппированные по категориям,
 * а также блок с пользовательскими константами.
 *
 * @return void
 */
function dumpAllConstants(): void
{
    // Массив всех констант; при true вернёт разбивку по категориям
    $all = get_defined_constants(true);

    echo "<h2>Все константы по категориям</h2>";
    echo '<pre>';

    echo htmlspecialchars(var_export($all, true), ENT_QUOTES, 'UTF-8');
    echo '</pre>';

    echo "<h2>Пользовательские константы (категория user)</h2>";
    echo '<pre>';
    $user = $all['user'] ?? [];
    echo htmlspecialchars(var_export($user, true), ENT_QUOTES, 'UTF-8');
    echo '</pre>';
}

// Для своей константы
define('MY_DEMO_CONST', 123);

echo "<!doctype html><html><head><meta charset='utf-8'><title>Константы PHP</title></head><body>";
echo "<h1>Определённые в PHP константы</h1>";
dumpAllConstants();
echo "</body></html>";
