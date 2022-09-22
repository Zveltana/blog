<?php

namespace Application\Lib;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO {
        if($this->database === null){
            $this->database = new \PDO('mysql:dbname=blog_php;host=localhost', 'root', '');
        }

        return $this->database;
    }
}
