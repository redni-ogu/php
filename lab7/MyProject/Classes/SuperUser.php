<?php
namespace MyProject\Classes;

class SuperUser extends User
{
    public $role;

    public function __construct($name, $login, $password, $role){
        parent::__construct($name, $login, $password);
        $this->role = $role;
    }

    public function showInfo(){
        echo 'Имя: '   . $this->getName()   . '<br>';
        echo 'Логин: ' . $this->getLogin()  . '<br>';
        echo 'Пароль: ' . $this->getPassword() . '<br>';
        echo 'Роль: '  . $this->role . '<br>';
        echo '<hr>';
    }
}