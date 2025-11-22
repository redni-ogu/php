<?php declare(strict_types=1); ?>

<?php
/**
 * Отправляет письмо с формы обратной связи.
 *
 * @param string $subject Тема письма.
 * @param string $body    Текст письма.
 * @return bool true при успешной отправке.
 */
function sendFeedback(string $subject, string $body): bool
{
    $to = 'rednickin.nikita@yandex.ru';
    $headers  = "From: admin@center.ogu\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    return mail($to, $subject, $body, $headers);
}

$sent  = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Забираем данные из формы и фильтруем
    $subject = htmlspecialchars(strip_tags(trim($_POST['subject'] ?? '')), ENT_QUOTES, 'UTF-8');
    $body    = htmlspecialchars(strip_tags(trim($_POST['body'] ?? '')), ENT_QUOTES, 'UTF-8');

    if ($subject === '' || $body === '') {
        $error = 'Заполните все поля формы.';
    } else {
        $sent = sendFeedback($subject, $body);
        if (!$sent) {
            $error = 'Не удалось отправить письмо.';
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Контакты</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <!-- Верхняя часть страницы -->
    <img src="logo.png" width="130" height="80" alt="Наш логотип" class="logo">
    <span class="slogan">приходите к нам учиться</span>
    <!-- Верхняя часть страницы -->
</header>

<section>
    <!-- Заголовок -->
    <h1>Обратная связь</h1>
    <!-- Заголовок -->

    <!-- Сообщения об ошибке / успехе -->
    <?php if ($error !== ''): ?>
        <p class="error" style="color:red;">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php elseif ($sent === true): ?>
        <p class="success" style="color:green;">
            Сообщение успешно отправлено.
        </p>
    <?php endif; ?>

    <!-- Область основного контента -->
    <h3>Адрес</h3>
    <address>123456 Москва, Малый Американский переулок 21</address>

    <h3>Задайте вопрос</h3>
    <form action="" method="post">
        <p>
            <label for="subject">Тема письма:</label><br>
            <input name="subject" id="subject" type="text" size="50" required>
        </p>
        <p>
            <label for="body">Содержание:</label><br>
            <textarea name="body" id="body" cols="50" rows="10" required></textarea>
        </p>
        <p>
            <input type="submit" value="Отправить">
        </p>
    </form>
    <!-- Область основного контента -->
</section>

<nav>
    <h2>Навигация по сайту</h2>
    <!-- Меню -->
    <ul>
        <li><a href="index.php">Домой</a></li>
        <li><a href="about.php">О нас</a></li>
        <li><a href="contact.php">Контакты</a></li>
        <li><a href="table.php">Таблица умножения</a></li>
        <li><a href="calc.php">Калькулятор</a></li>
    </ul>
    <!-- Меню -->
</nav>

<footer>
    <!-- Нижняя часть страницы -->
    &copy; Супер Мега Веб-мастер - Никитка 2004, 2025 год нашей эры &ndash; 20xx
    <!-- Нижняя часть страницы -->
</footer>
</body>

</html>
