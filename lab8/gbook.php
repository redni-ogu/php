<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

// Подключение к MySQL
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$link) {
    die('Ошибка подключения к БД: ' . mysqli_connect_error());
}

// Установка кодировки
mysqli_set_charset($link, DB_CHARSET);

// ЗАДАНИЕ 3: удаление записи по GET ?del=ID
if (isset($_GET['del'])) {
    $delId = trim($_GET['del']);
    $delId = htmlspecialchars($delId, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $delId = mysqli_real_escape_string($link, $delId);
    $delId = (int)$delId;

    if ($delId > 0) {
        $sql = "DELETE FROM msgs WHERE id = {$delId}";
        mysqli_query($link, $sql);
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// ЗАДАНИЕ 1: приём POST‑формы и вставка записи
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']  ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg   = trim($_POST['msg']   ?? '');

    // Очистка для HTML
    $name  = htmlspecialchars($name,  ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $msg   = htmlspecialchars($msg,   ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    // Экранирование для SQL
    $name  = mysqli_real_escape_string($link, $name);
    $email = mysqli_real_escape_string($link, $email);
    $msg   = mysqli_real_escape_string($link, $msg);

    if ($name !== '' && $msg !== '') {
        $sql = "
    INSERT INTO msgs (name, email, msg)
    VALUES ('{$name}', '{$email}', '{$msg}')
";
        mysqli_query($link, $sql);
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// ЗАДАНИЕ 2: выборка сообщений
$sql = "SELECT id, name, email, msg FROM msgs ORDER BY id DESC";
$result = mysqli_query($link, $sql);

if ($result === false) {
    die('Ошибка запроса: ' . mysqli_error($link));
}

$rowsCount = mysqli_num_rows($result);
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Гостевая книга</title>
    </head>
    <body>

    <h1>Гостевая книга</h1>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" method="post">
        Ваше имя:<br>
        <input type="text" name="name"><br>
        Ваш E-mail:<br>
        <input type="email" name="email"><br>
        Сообщение:<br>
        <textarea name="msg" cols="50" rows="5"></textarea><br><br>
        <input type="submit" value="Добавить!">
    </form>

    <hr>

    <p>Всего сообщений: <?= $rowsCount ?></p>

    <?php if ($rowsCount > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div style="margin-bottom: 1em; border-bottom: 1px solid #ccc; padding-bottom: .5em;">
                <strong><?= htmlspecialchars($row['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></strong>
                <?php if (!empty($row['email'])): ?>
                    (<?= htmlspecialchars($row['email'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>)
                <?php endif; ?>
                <p><?= nl2br(htmlspecialchars($row['msg'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>

                <a href="?del=<?= (int)$row['id'] ?>"
                   onclick="return confirm('Удалить это сообщение?');">
                    Удалить
                </a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Сообщений пока нет.</p>
    <?php endif; ?>

    </body>
    </html>
<?php
// Закрываем соединение
mysqli_free_result($result);
mysqli_close($link);
