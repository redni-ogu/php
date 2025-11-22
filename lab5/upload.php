<?php declare(strict_types=1); ?>

<?php
/**
 * Обрабатывает загрузку файла, если он был отправлен.
 *
 * @return void
 */
function handleUpload(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    if (!isset($_FILES['fupload']) || $_FILES['fupload']['error'] === UPLOAD_ERR_NO_FILE) {
        echo '<p>Файл не был выбран.</p>';
        return;
    }

    $file = $_FILES['fupload'];

    echo '<p>Имя файла: ' . htmlspecialchars($file['name'], ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p>Размер: ' . (int)$file['size'] . ' байт</p>';
    echo '<p>Временный файл: ' . htmlspecialchars($file['tmp_name'], ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p>Код ошибки: ' . (int)$file['error'] . '</p>';

    if (!is_uploaded_file($file['tmp_name'])) {
        echo '<p style="color:red;">Файл не является загруженным.</p>';
        return;
    }

    // Определяем MIME-тип по содержимому
    $mime = mime_content_type($file['tmp_name']); // [web:387][web:381][web:384]
    echo '<p>Тип (MIME): ' . htmlspecialchars((string)$mime, ENT_QUOTES, 'UTF-8') . '</p>';

    if ($mime === 'image/jpeg') {
        // Имя файла — его MD5-хеш
        $hash = md5_file($file['tmp_name']);
        $targetDir  = __DIR__ . '/upload';
        $targetPath = $targetDir . '/' . $hash . '.jpg';

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            echo '<p style="color:green;">Файл успешно загружен как ' .
                htmlspecialchars($hash . '.jpg', ENT_QUOTES, 'UTF-8') . '</p>';
        } else {
            echo '<p style="color:red;">Ошибка при перемещении файла.</p>';
        }
    } else {
        echo '<p style="color:red;">Можно загружать только JPEG-изображения.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка файла на сервер</title>
</head>
<body>
<div>
    <?php handleUpload(); ?>
</div>

<form enctype="multipart/form-data"
      action="<?=htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8')?>"
      method="post">
    <p>
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
        <input type="file" name="fupload"><br>
        <button type="submit">Загрузить</button>
    </p>
</form>
</body>
</html>
