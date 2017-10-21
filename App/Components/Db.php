<?php

namespace App\Components;

use PDO;
use App\Components\Singleton;

class Db
{
    use Singleton;

    protected $dbh;

    protected function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=krosava_15', 'profi1', 'profisSd0987asdf');
        } catch (\PDOException $e) {
            throw new \App\Exceptions\Db('Нет соединения с базой');
        }
    }

    public function execute($sql, $data = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
        } catch (\PDOException $e) {
            throw new \App\Exceptions\Db('Ошибка в запросе');
        }
        
        return $sth->execute($data);
    }

    public function query($sql, $class = \stdClass::class, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        } else {
            throw new \App\Exceptions\Db('Ошибка в запросе');
        }
    }

    public function queryEach($sql, $class = \stdClass::class, $data = [])
    {
        $sth = $this->dbh->prepare($sql);

        try {
            $sth->execute($data);
        } catch (\PDOException $e) {
            throw new \App\Exceptions\Db('Ошибка в запросе');
        }

        $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
        while ($result = $sth->fetch()) {
            yield $result;
        }

        if (!$result) {
            yield false;
        }
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

}