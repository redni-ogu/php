<?php declare(strict_types=1); ?>

<?php
$result = null;
$error  = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['num1'], $_GET['num2'], $_GET['operator'])) {
    // Забираем и чистим данные
    $num1_str   = trim($_GET['num1']);
    $num2_str   = trim($_GET['num2']);
    $operator   = trim($_GET['operator']);

    if ($num1_str === '' || $num2_str === '' || $operator === '') {
        $error = 'Заполните все поля калькулятора.';
    } elseif (!is_numeric($num1_str) || !is_numeric($num2_str)) {
        $error = 'Число 1 и Число 2 должны быть числами.';
    } else {
        $num1 = (float)$num1_str;
        $num2 = (float)$num2_str;

        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
            case 'x':
            case 'X':
                $result = $num1 * $num2;
                break;
            case '/':
            case ':':
                if ($num2 == 0.0) {
                    $error = 'Деление на ноль запрещено.';
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $error = 'Допустимые операторы: +, -, *, /.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section>

    <!-- Вывод ошибки / результата -->
    <?php if ($error !== ''): ?>
        <p style="color:red;">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php elseif ($result !== null): ?>
        <p style="color:green;">
            Результат: <?= htmlspecialchars((string)$result, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <!-- Область основного контента -->
    <form action="" method="get">
        <label for="num1">Число 1:</label>
        <br>
        <input name="num1" id="num1" type="text" value="<?= isset($num1_str) ? htmlspecialchars($num1_str, ENT_QUOTES, 'UTF-8') : '' ?>">
        <br>
        <label for="operator">Оператор: </label>
        <br>
        <input name="operator" id="operator" type="text" value="<?= isset($operator) ? htmlspecialchars($operator, ENT_QUOTES, 'UTF-8') : '' ?>" placeholder="+  -  *  /">
        <br>
        <label for="num2">Число 2: </label>
        <br>
        <input name="num2" id="num2" type="text" value="<?= isset($num2_str) ? htmlspecialchars($num2_str, ENT_QUOTES, 'UTF-8') : '' ?>">
        <br>
        <br>
        <input type="submit" value="Считать">
    </form>
    <!-- Область основного контента -->
</section>
</body>
</html>
