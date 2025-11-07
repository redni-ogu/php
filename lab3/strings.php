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

// 1) login: trim + к нижнему регистру
$login = mb_strtolower(trim($login), 'UTF-8'); // [web:189][web:188]

// 2) password: проверка сложности
$passwordOk = isPasswordStrong($password); // [web:195][web:191]

// 3) name: первая буква прописная (UTF‑8)
$name = mb_ucfirst_fallback(mb_strtolower($name, 'UTF-8')); // [web:186][web:187]

// 4) email: валидация через filter_var
$isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false; // [web:196][web:200]

// 5) code: вывести в браузер буквально как в коде — экранируем спецсимволы
$codeLiteral = htmlspecialchars($code, ENT_QUOTES, 'UTF-8'); // [web:205][web:201]

// Демонстрация результата
echo '<pre>';
echo "login: {$login}\n";                          // user
echo "password strong: " . ($passwordOk ? 'yes' : 'no') . "\n";
echo "name: {$name}\n";                            // Иван
echo "email valid: " . ($isEmailValid ? 'yes' : 'no') . "\n";
echo "code literal: {$codeLiteral}\n";             // выводит '<?=$login?>' как текст
echo '</pre>';
