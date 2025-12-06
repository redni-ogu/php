<?php
namespace MyProject\Classes;

/**
 * Класс суперпользователя, расширяющий базовый класс User.
 *
 * Добавляет свойство роли пользователя и выводит расширенную
 * информацию о пользователе, включая его роль.
 */
class SuperUser extends User
{
    /**
     * Роль пользователя (например, admin, moderator и т.п.).
     *
     * @var string
     */
    public $role;

    /**
     * Конструктор суперпользователя.
     *
     * @param string $name     Имя пользователя.
     * @param string $login    Логин пользователя.
     * @param string $password Пароль пользователя.
     * @param string $role     Роль пользователя.
     */
    public function __construct($name, $login, $password, $role){
        parent::__construct($name, $login, $password);
        $this->role = $role;
    }

    /**
     * Выводит информацию о суперпользователе:
     * имя, логин, пароль и роль.
     *
     * @return void
     */
    public function showInfo(){
        echo 'Имя: '   . $this->getName()   . '<br>';
        echo 'Логин: ' . $this->getLogin()  . '<br>';
        echo 'Пароль: ' . $this->getPassword() . '<br>';
        echo 'Роль: '  . $this->role . '<br>';
        echo '<hr>';
    }
}
