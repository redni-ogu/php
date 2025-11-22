<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Навигация по проектам</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        .directory {
            margin-bottom: 25px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }

        .subdirectory {
            margin: 15px 0 10px 20px;
            background: #f0f0f0;
            padding: 12px;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }

        .directory-name {
            font-weight: bold;
            font-size: 1.2em;
            color: #007bff;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .subdirectory-name {
            font-weight: bold;
            font-size: 1.1em;
            color: #28a745;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .directory-name::before {
            content: "📁";
            margin-right: 8px;
        }

        .subdirectory-name::before {
            content: "📂";
            margin-right: 8px;
        }

        .file-list {
            list-style: none;
            margin-left: 20px;
        }

        .file-item {
            margin: 5px 0;
            padding: 8px 12px;
            background: white;
            border-radius: 3px;
            transition: background-color 0.2s;
        }

        .file-item:hover {
            background-color: #e9ecef;
        }

        .file-link {
            text-decoration: none;
            color: #495057;
            display: flex;
            align-items: center;
        }

        .file-link::before {
            content: "📄";
            margin-right: 8px;
        }

        .file-link:hover {
            color: #007bff;
        }

        .empty {
            color: #6c757d;
            font-style: italic;
            margin-left: 20px;
        }

        .current-dir {
            text-align: center;
            color: #6c757d;
            margin-bottom: 20px;
            font-size: 0.9em;
        }

        .breadcrumb {
            background: #e9ecef;
            padding: 8px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Навигация по проектам</h1>

    <?php
    // Получаем текущую директорию
    $currentDir = getcwd();
    echo "<div class='current-dir'>Текущая директория: " . htmlspecialchars($currentDir) . "</div>";

    // Функция для проверки, является ли файл PHP файлом
    function isPhpFile($filename) {
        return pathinfo($filename, PATHINFO_EXTENSION) === 'php';
    }

    // Функция для получения "красивого" имени файла
    function getDisplayName($filename) {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        // Заменяем подчеркивания и дефисы на пробелы
        $name = str_replace(['_', '-'], ' ', $name);
        // Делаем первую букву заглавной
        return $name;
    }

    // Рекурсивная функция для поиска PHP файлов в директории и поддиректориях
    function findPhpFiles($dir, $baseDir = '') {
        $phpFiles = [];

        try {
            $items = scandir($dir);

            foreach ($items as $item) {
                if ($item === '.' || $item === '..') continue;

                $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
                $relativePath = $baseDir ? $baseDir . '/' . $item : $item;

                if (is_dir($fullPath)) {
                    // Рекурсивно ищем в поддиректории
                    $subDirFiles = findPhpFiles($fullPath, $relativePath);
                    $phpFiles = array_merge($phpFiles, $subDirFiles);
                } elseif (is_file($fullPath) && isPhpFile($item)) {
                    $phpFiles[] = [
                        'path' => $relativePath,
                        'name' => $item,
                        'display_name' => getDisplayName($item)
                    ];
                }
            }
        } catch (Exception $e) {
            // Пропускаем директории, к которым нет доступа
        }

        return $phpFiles;
    }

    // Функция для организации файлов по директориям
    function organizeFilesByDirectory($files) {
        $organized = [];

        foreach ($files as $file) {
            $pathParts = explode('/', $file['path']);
            $fileName = array_pop($pathParts);

            if (empty($pathParts)) {
                // Файл в корневой директории
                if (!isset($organized[''])) {
                    $organized[''] = [];
                }
                $organized[''][] = [
                    'name' => $fileName,
                    'display_name' => $file['display_name'],
                    'full_path' => $file['path']
                ];
            } else {
                // Файл в поддиректории
                $dirPath = implode('/', $pathParts);
                if (!isset($organized[$dirPath])) {
                    $organized[$dirPath] = [];
                }
                $organized[$dirPath][] = [
                    'name' => $fileName,
                    'display_name' => $file['display_name'],
                    'full_path' => $file['path']
                ];
            }
        }

        return $organized;
    }

    // Получаем список всех элементов в текущей директории
    $items = scandir($currentDir);

    // Фильтруем только директории (исключаем текущую ".", родительскую ".." и скрытые директории)
    $directories = array_filter($items, function($item) use ($currentDir) {
        $fullPath = $currentDir . DIRECTORY_SEPARATOR . $item;
        return is_dir($fullPath) &&
            $item !== '.' &&
            $item !== '..' &&
            $item[0] !== '.';
    });

    // Сортируем директории по имени
    sort($directories);

    // Если директорий нет, выводим сообщение
    if (empty($directories)) {
        echo "<p class='empty'>Директории не найдены</p>";
    }

    // Проходим по каждой директории
    foreach ($directories as $directory) {
        $dirPath = $currentDir . DIRECTORY_SEPARATOR . $directory;

        echo "<div class='directory'>";
        echo "<div class='directory-name'>" . htmlspecialchars($directory) . "</div>";

        // Ищем все PHP файлы в директории и поддиректориях
        $allPhpFiles = findPhpFiles($dirPath, $directory);

        if (empty($allPhpFiles)) {
            echo "<p class='empty'>Нет PHP файлов</p>";
        } else {
            // Организуем файлы по директориям
            $organizedFiles = organizeFilesByDirectory($allPhpFiles);

            // Сортируем по путям директорий
            ksort($organizedFiles);

            foreach ($organizedFiles as $subDir => $files) {
                if ($subDir === '') {
                    // Файлы в основной директории
                    echo "<ul class='file-list'>";
                    foreach ($files as $file) {
                        echo "<li class='file-item'>";
                        echo "<a href='" . htmlspecialchars($file['full_path']) . "' class='file-link'>";
                        echo htmlspecialchars($file['display_name']);
                        echo "</a>";
                        echo "</li>";
                    }
                    echo "</ul>";
                } else {
                    // Файлы в поддиректории
                    echo "<div class='subdirectory'>";
                    echo "<div class='subdirectory-name'>" . htmlspecialchars($subDir) . "</div>";
                    echo "<ul class='file-list'>";
                    foreach ($files as $file) {
                        echo "<li class='file-item'>";
                        echo "<a href='" . htmlspecialchars($file['full_path']) . "' class='file-link'>";
                        echo htmlspecialchars($file['display_name']);
                        echo "</a>";
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                }
            }
        }

        echo "</div>";
    }
    ?>
</div>
</body>
</html>