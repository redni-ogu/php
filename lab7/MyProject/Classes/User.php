<?php
namespace MyProject\Classes;

class User
{
public $name;
public $login;

private $password;

function __construct($name, $login, $password){
    $this->name = $name;
    $this->login = $login;
    $this->password = $password;
}

function getName(){
    return $this->name;
}

function getLogin(){
    return $this->login;
}

function getPassword(){
    return $this->password;
}

function showInfo(){
    echo 'Имя: ' . $this->name . '<br />';
    echo 'Логин: ' . $this->login . '<br />';
    echo 'Пароль: ' . $this->password . '<br />';
}

function __destruct(){
    echo "Пользователь {$this->getLogin()} удалён";
}

}