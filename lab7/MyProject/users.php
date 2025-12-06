<?php
declare(strict_types=1);

require __DIR__ . '/Classes/User.php';
require __DIR__ . '/Classes/SuperUser.php';

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
