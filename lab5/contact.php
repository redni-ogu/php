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
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты</title>
</head>
<body>

<h1>Обратная связь</h1>

<?php if ($error !== ''): ?>
    <p style="color:red;"><?=htmlspecialchars($error, ENT_QUOTES, 'UTF-8')?></p>
<?php elseif ($sent === true): ?>
    <p style="color:green;">Сообщение успешно отправлено.</p>
<?php endif; ?>

<form method="post" action="">
    <p>
        <label for="subject">Тема</label><br>
        <input type="text" name="subject" id="subject" required>
    </p>
    <p>
        <label for="body">Сообщение</label><br>
        <textarea name="body" id="body" rows="5" cols="40" required></textarea>
    </p>
    <button type="submit">Отправить</button>
</form>

</body>
</html>
