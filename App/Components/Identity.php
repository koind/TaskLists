<?php

namespace App\Components;

use App\Views\View;
use App\Models\User;

class Identity
{

    public function __construct()
    {
        session_start();
    }

    public function check($data)
    {
        $user = User::findByLogin($data->login);
        if (false === $user) {
            throw new \App\Exceptions\Identity('Пользователь с логином ' . $data->login . ' не существует');
        }
        if (!password_verify($data->password, $user->password)) {
            throw new \App\Exceptions\Identity('Неверный пароль');
        }
        return true;
    }

    public function authenticate($data)
    {
        $user = User::findByLogin($data->login);

        if (false === $user) {
            throw new \App\Exceptions\Identity('Пользователь с логином ' . $data->login . ' не существует');
        }        
        if (!password_verify($data->password, $user->password)) {
            throw new \App\Exceptions\Identity('Неверный пароль');
        }
        $this->login($user);

        return $user;
    }
    public function getUser()
    {
        return $_SESSION['user'];
    }
    public function login($user)
    {
        $_SESSION['user'] = $user;
    }
    public function logout()
    {
        unset($_SESSION['user']);
    }

}