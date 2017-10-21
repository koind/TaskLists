<?php

namespace App\Components;

trait Magic
{
    protected $date = [];

    public function __set($k, $v)
    {
        $this->date[$k] = $v;
    }

    public function __get($k)
    {
        return $this->date[$k];
    }

    public function __isset($k)
    {
        return isset($this->date[$k]);
    }
}