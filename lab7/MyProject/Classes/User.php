<?php
namespace MyProject\Classes;

/**
 * Класс пользователя.
 *
 * Содержит основные данные о пользователе (имя, логин, пароль)
 * и методы для получения информации и вывода её на экран.
 */
class User
{
    /**
     * Имя пользователя.
     *
     * @var string
     */
    public $name;

    /**
     * Логин пользователя.
     *
     * @var string
     */
    public $login;

    /**
     * Пароль пользователя.
     *
     * @var string
     */
    private $password;

    /**
     * Конструктор пользователя.
     *
     * @param string $name     Имя пользователя.
     * @param string $login    Логин пользователя.
     * @param string $password Пароль пользователя.
     */
    public function __construct($name, $login, $password){
        $this->name     = $name;
        $this->login    = $login;
        $this->password = $password;
    }

    /**
     * Возвращает имя пользователя.
     *
     * @return string Имя пользователя.
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Возвращает логин пользователя.
     *
     * @return string Логин пользователя.
     */
    public function getLogin(){
        return $this->login;
    }

    /**
     * Возвращает пароль пользователя.
     *
     * @return string Пароль пользователя.
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * Выводит информацию о пользователе:
     * имя, логин и пароль.
     *
     * @return void
     */
    public function showInfo(){
        echo 'Имя: '    . $this->name     . '<br />';
        echo 'Логин: '  . $this->login    . '<br />';
        echo 'Пароль: ' . $this->password . '<br />';
        echo '<hr>';
    }

    /**
     * Деструктор пользователя.
     *
     * Выводит сообщение об удалении пользователя.
     *
     * @return void
     */
    public function __destruct(){
        echo "Пользователь {$this->getLogin()} удалён<br>";
    }
}
