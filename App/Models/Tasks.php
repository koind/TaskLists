<?php

namespace App\Models;

use App\Components\Magic;
use App\Models\Model;
use App\Exceptions\MultiException;

class Tasks extends Model
{
    use Magic;

    const TABLE = 'tasks';

    protected $date = [];

    public function __set($k, $v)
    {
        if (isset($v)) {
        	$this->date[$k] = $v;	
        }
    }

    public function __get($k)
    {
        return $this->date[$k];
    }

    public function __isset($k)
    {
        return isset($this->date[$k]);
    }
    

    public function fill($data = [])
    {
        $e = new MultiException();

        $i=0;
        
        foreach ($data as $key => $value) {

            if ('id' == $data[$key]) {
                continue;
            }

            if (empty($data[$key]) || ' ' == $data[$key]) {
                $e[] = new \Exception('Поле ' . $key . ' пустое');
                ++$i;
            } else {
                $this->$key = $this->clearTegs($value);
            }
        }

        if (0 != $i) {
            throw $e;
        }

        return $e;
    }

    protected function clearTegs($item)
    {
        return trim(strip_tags($item));
    }
}