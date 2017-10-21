<?php

namespace App\Controllers;

use App\Exceptions\E404;

abstract class Controller
{
    public function __construct()
    {
    }

    public function action($action)
    {
        $methodName = 'action' . $action;
        $this->beforeAction();
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        } else {
            throw new E404('Страница не найдена');
        }

    }

    protected function redirect($url)
    {
        header('Location: ' . $url, true, 302);
    }

}