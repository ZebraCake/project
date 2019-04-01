<?php

namespace App\Auth;

class User
{
    private $pdo;
    private $token;
    private $login = 'anonimous';
    private $user_id;

    public function __construct ($pdo)
    {
        $this->pdo = $pdo;
        if(!$this->isAuth()) {
            if(isset($_POST['login']) && isset($_POST['password'])) {
                $this->login($_POST['login'],$_POST['password']);
            }
        }
    }

    public function isAuth()
    {

        if($this->user_id !==null) return true;

        if(
            isset($_SESSION['user']) &&
            isset($_SESSION['user']['token']) &&
            isset($_SESSION['user']['login']) &&
            $_SESSION['user']['token'] === md5(
                $_SESSION['user']['login']
                . $_SERVER['REMOTE_ADDR']
                . $_SERVER['HTTP_USER_AGENT']
            )
        ) {
            $this->user_id = $_SESSION['user']['user_id'];
            $this->login = $_SESSION['user']['login'];
            return true;
        }

    }

    public function login($login, $password) {
        $query = "SELECT * FROM `user` WHERE `login` = :login AND `password` = :password;";

        $password = md5($password);
        $result = $this->pdo->prepare($query);
        $result->bindValue('login', $login);
        $result->bindValue('password', $password);
        $result->execute();
        $result = $result->fetchAll();
        if(count($result) > 0) {
            $this->login = $login;
            $this->user_id = $result[0]['id']; //первая строка и столбец 'id' результата
            $this->token = md5(
                $login
                . $_SERVER['REMOTE_ADDR']
                . $_SERVER['HTTP_USER_AGENT']);
            $_SESSION['user'] = [
                'login' => $this->login,
                'user_id' => $this->user_id,
                'token' => $this->token,
            ];
        }
    }
    public function getUserName() {
        return $this->login;
    }

    public function logout() {
        $this->user_id = null;
        $this->token = null;
        $this->login = 'Anonimous';
        unset($_SESSION['user']);
    }
}

