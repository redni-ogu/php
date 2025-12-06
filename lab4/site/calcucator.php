<?php declare(strict_types=1); ?>

<?php
/**
 * Выполняет арифметическую операцию над двумя числами.
 *
 * @param float $a Первое число.
 * @param float $b Второе число.
 * @param string $operator Оператор: "+", "-", "*", "/".
 * @return float Результат вычисления.
 *
 * @throws InvalidArgumentException При неизвестном операторе или делении на ноль.
 */
function calculate(float $a, float $b, string $operator): float
{
    switch ($operator) {
        case '+':
            return $a + $b;
        case '-':
            return $a - $b;
        case '*':
            return $a * $b;
        case '/':
            if ($b == 0.0) {
                throw new InvalidArgumentException('На ноль делить нельзя.');
            }
            return $a / $b;
        default:
            throw new InvalidArgumentException('Неизвестный оператор.');
    }
}

// ЗАДАНИЕ 1

$result    = null;   // результат вычисления
$error     = '';     // текст ошибки
$num1Value = '';     // введённое пользователем число 1 (для сохранения в форме)
$num2Value = '';     // введённое пользователем число 2
$operator  = '+';    // выбранный оператор по умолчанию

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Сохраняем "сырые" значения для повторного вывода в форму
    $num1Value = trim($_POST['num1'] ?? '');
    $num2Value = trim($_POST['num2'] ?? '');
    $operator  = $_POST['operator'] ?? '+';

    // Фильтрация чисел: оставляем только допустимые символы для float
    $num1Filtered = filter_var(
        $num1Value,
        FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION
    ); // [web:363][web:360]

    $num2Filtered = filter_var(
        $num2Value,
        FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION
    ); // [web:363][web:360]

    if ($num1Value === '' || $num2Value === '') {
        $error = 'Оба числа обязательны для ввода.';
    } elseif (!is_numeric($num1Filtered) || !is_numeric($num2Filtered)) {
        $error = 'Введите корректные числовые значения.';
    } else {
        $a = (float) $num1Filtered;
        $b = (float) $num2Filtered;

        try {
            $result = calculate($a, $b, $operator); // [web:357][web:355]
        } catch (InvalidArgumentException $e) {
            $error = $e->getMessage();
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
</head>
<body>

<?php
// ЗАДАНИЕ 2: выводим результат, если он существует
if ($error !== '') {
    echo '<p style="color:red;">Ошибка: ' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
} elseif ($result !== null) {
    echo '<p>Результат: ' . htmlspecialchars((string) $result, ENT_QUOTES, 'UTF-8') . '</p>';
}
?>

<form action="<?=htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8')?>" method="post">
    <p>
        <label for="num1">Число 1</label><br>
        <input type="text"
               name="num1"
               id="num1"
               required
               value="<?=htmlspecialchars($num1Value, ENT_QUOTES, 'UTF-8')?>">
    </p>

    <p>
        <label for="operator">Оператор</label><br>
        <select name="operator" id="operator">
            <option value="+"
                <?= $operator === '+' ? 'selected' : '' ?>>+</option>
            <option value="-"
                <?= $operator === '-' ? 'selected' : '' ?>>-</option>
            <option value="*"
                <?= $operator === '*' ? 'selected' : '' ?>>*</option>
            <option value="/"
                <?= $operator === '/' ? 'selected' : '' ?>>/</option>
        </select>
    </p>

    <p>
        <label for="num2">Число 2</label><br>
        <input type="text"
               name="num2"
               id="num2"
               required
               value="<?=htmlspecialchars($num2Value, ENT_QUOTES, 'UTF-8')?>">
    </p>

    <button type="submit">Считать!</button>
</form>

</body>
</html>
