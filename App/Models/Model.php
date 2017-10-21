<?php

namespace App\Models;

use App\Exceptions\E404;
use App\Components\Db;

abstract class Model
{
    const TABLE = '';

    public $id;

    public static function findAll($field = 'id', $sorting = 'ASC')
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' ORDER BY ' . $field . ' ' . $sorting . ' ',
            static::class
        );
    }

    public static function findAllEach()
    {
        $db = Db::instance();
        return $db->queryEach(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
    }

    public static function findById($id)
    {
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE id=:id',
            static::class,
            [':id' => $id]
        );

        if ($res) {
            return $res[0];
        } else {
            return false;
        }
    }

    public static function findByLogin($login)
    {
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE login=:login',
            static::class,
            [':login' => $login]
        );

        if ($res) {
            return $res[0];
        } else {
            return false;
        }
    } 

    protected function insert()
    {
        $colums = [];
        $values = [];
        foreach ($this as $k => $value) {
            if ('date' == $k) {
                foreach ($value as $key => $val) {
                    $values[':' . $key] = $val;
                    if ('id' == $key) {
                        continue;
                    }
                    $colums[] = $key;
                }
            }
        }

        $sql = '
          INSERT INTO ' . static::TABLE . ' 
          (' . implode(',', $colums) . ')
          VALUES
          (' . implode(',', array_keys($values)) . ')
        ';

        $db = Db::instance();
        $res = $db->execute($sql, $values);
        $this->id = $db->lastInsertId();

        return $res;
    }

    protected function update()
    {
        $colums = [];
        $values = [];
        foreach ($this as $k => $value) {
            if ('date' == $k) {
                foreach ($value as $key => $val) {
                	$values[':' . $key] = $val;
		            if ('id' == $key) {
		                continue;
		            }
		            $colums[] = $key . '=:' . $key;
                }
            }
            
        }
        $values[':id'] = $this->id;

        $sql = '
            UPDATE ' . static::TABLE . '
            SET ' . implode(',', $colums) . '
            WHERE id=:id
        ';

        $db = Db::instance();
        return $db->execute($sql, $values);
    }

    protected function isNew()
    {
        return empty($this->id);
    }

    public function save()
    {
        if ($this->isNew()) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    public function delete()
    {
        $colums = [];
        $values = [];
        foreach ($this as $k => $value) {
            if ('id' == $k) {
                $values[':' . $k] = $value;
                $colums[] = $k . '=:' . $k;
            }
            continue;
        }

        $sql = '
            DELETE FROM ' . static::TABLE . '
            WHERE ' . implode(',', $colums) . '
        ';

        $db = Db::instance();
        $db->execute($sql, $values);
    }

}