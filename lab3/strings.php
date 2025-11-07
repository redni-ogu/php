<?php declare(strict_types=1); ?>

<?php
/**
 * Проверяет пароль на минимальную сложность.
 * Требования: хотя бы одна заглавная латинская буква, одна строчная, одна цифра, длина ≥ 8.
 *
 * @param string $password Проверяемый пароль.
 * @return bool true, если пароль удовлетворяет правилам, иначе false.
 */
function isPasswordStrong(string $password): bool
{
    // Пример шаблона: (?=.*[A-Z]) (?=.*[a-z]) (?=.*\d) .{8,}
    return (bool) preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $password); // [web:195][web:191]
}

/**
 * Делает первый символ строки прописным с учетом многобайтовой кодировки (UTF‑8).
 *
 * @param string $str Входная строка.
 * @return string Строка с заглавной первой буквой.
 */
function mb_ucfirst_fallback(string $str): string
{
    // Если доступна mb_ucfirst (PHP 8.4+), используем её
    if (function_exists('mb_ucfirst')) {
        return mb_ucfirst($str, 'UTF-8'); // [web:186][web:194]
    }
    // Иначе — безопасная реализация через mb_substr/mb_strtoupper
    $first = mb_strtoupper(mb_substr($str, 0, 1, 'UTF-8'), 'UTF-8'); // [web:187][web:188]
    return $first . mb_substr($str, 1, null, 'UTF-8'); // [web:187][web:188]
}

// ЗАДАНИЕ 1: исходные данные
$login = ' User ';
$password = 'megaP@ssw0rd';
$name = 'иван';
$email = 'ivan@petrov.ru';
$code = '<?=$login?>';

// ЗАДАНИЕ 2:

$login = mb_strtolower(trim($login), 'UTF-8');
$passwordOk = isPasswordStrong($password);
$name = mb_ucfirst_fallback(mb_strtolower($name, 'UTF-8'));
$isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;

$codeLiteral = htmlspecialchars($code, ENT_QUOTES, 'UTF-8');

// Демонстрация результата
echo '<pre>';
echo "login: {$login}\n";
echo "password strong: " . ($passwordOk ? 'yes' : 'no') . "\n";
echo "name: {$name}\n";
echo "email valid: " . ($isEmailValid ? 'yes' : 'no') . "\n";
echo "code literal: {$codeLiteral}\n";
echo '</pre>';
