<?php
declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    // Префикс нашего пространства имён
    $prefix = 'MyProject\\Classes\\';

    // Базовая директория для классов относительно users.php
    // (users.php в lab7, классы в lab7/MyProject/Classes)
    $baseDir = __DIR__ . '/MyProject/Classes/';

    // Если класс не из нашего пространства имён — пропускаем
    if (strpos($class, $prefix) !== 0) {
        return;
    }

    // Имя класса без префикса пространства имён (User, SuperUser)
    $relativeClass = substr($class, strlen($prefix));

    // Формируем путь к файлу
    $file = $baseDir . $relativeClass . '.php';

    if (is_file($file)) {
        require $file;
    }
});

use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

$user1 = new User('Иван', 'ivan', 'pass1');
$user2 = new User('Мария', 'maria', 'pass2');
$user3 = new User('Пётр', 'petr', 'pass3');

$super = new SuperUser('Админ', 'admin', 'root', 'administrator');

$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

$super->showInfo();
