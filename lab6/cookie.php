<?php
declare(strict_types=1);

/**
 * Обрабатывает счётчик сообщений и время последнего визита с использованием cookie
 *
 * - Инит и ++ счетчика посещений
 * - Сохранение последнего визита
 *
 * @return array Массив с ключами:
 * - 'visits' => int количество посещений
 * - 'lastVisit' => string|null последний визит
 * - 'currentVisit' => string текущее время визита
 */
function  handleVisitCounter(): array{
    $visits = 0;
    if (isset($_COOKIE["visits"])){
        $visits = (int) $_COOKIE["visits"];
    }
    $visits++;

    $lastVisit = null;
    if (isset($_COOKIE["lastVisit"])){
        $lastVisitRaw = $_COOKIE["lastVisit"];
        $lastVisit = htmlspecialchars(trim($lastVisitRaw), ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }

    $expire = time() + 60 * 60 * 24; // 1 день в секундах

    $currentVisit = date("Y-m-d H:i:s", $expire);

    setcookie('visits', (string)$visits, $expire, '/');
    setcookie('lastVisit', $currentVisit, $expire, '/');

    return [
        "visits" => $visits,
        "lastVisit" => $lastVisit,
        "currentVisit" => $currentVisit
    ];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Последний визит</title>
</head>
<body>

<h1>Последний визит</h1>

<?php
$result = handleVisitCounter();

echo 'Вы посещали эту страницу: ' . $result["visits"];

if ($result['lastVisit'] !== null) {
    echo 'Предыдущее посещение: ' . $result["lastVisit"];
} else{
    echo 'Это ваш первый визит на страницу.';
}
echo 'Текущее посещение: ' . $result["currentVisit"];
?>

</body>
</html>