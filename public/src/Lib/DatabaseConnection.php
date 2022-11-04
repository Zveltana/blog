<?php

namespace Application\Lib;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO {
        require_once('src/Common/config.php');

        if($this->database === null){
            $this->database = new \PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USERNAME, DB_PASSWORD);
        }

        return $this->database;
    }
}
