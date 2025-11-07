<?php declare(strict_types=1); ?>

<?php
/**
 * Выводит имена всех функций для каждого загруженного PHP‑расширения,
 * затем печатает общее количество найденных функций.
 *
 * @return void
 */
function dumpExtensionFunctions(): void
{
    $total = 0;

    // Получаем список всех загруженных расширений
    $extensions = get_loaded_extensions(); // [web:246][web:259]

    sort($extensions, SORT_STRING | SORT_FLAG_CASE);

    foreach ($extensions as $ext) {
        // Некоторые реализации требуют нижний регистр для get_extension_funcs
        $funcs = get_extension_funcs(strtolower($ext)) ?: get_extension_funcs($ext); // [web:260][web:251]

        echo '<h2>' . htmlspecialchars($ext, ENT_QUOTES, 'UTF-8') . '</h2>';

        if ($funcs === false || empty($funcs)) {
            echo '<p><em>Нет экспортируемых функций</em></p>';
            continue;
        }

        sort($funcs, SORT_STRING | SORT_FLAG_CASE);
        $count = count($funcs); // [web:261]
        $total += $count;

        echo '<pre>' . htmlspecialchars(implode("\n", $funcs), ENT_QUOTES, 'UTF-8') . '</pre>';
        echo '<p>Всего функций в расширении: ' . $count . '</p>';
    }

    echo '<hr>';
    echo '<p><strong>Общее количество функций во всех расширениях: ' . $total . '</strong></p>';
}

echo "<!doctype html><html><head><meta charset='utf-8'><title>Функции расширений PHP</title></head><body>";
echo '<h1>Функции загруженных расширений</h1>';
dumpExtensionFunctions();
echo '</body></html>';
