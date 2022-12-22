<?php

namespace Application\Lib;

use Platformsh\ConfigReader\Config;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO {
        require_once('src/Common/config.php');

        $config = new Config();

        $credentials = $config->credentials('database');

        if($this->database === null){
            $this->database = new \PDO('mysql:dbname='.$credentials['path'].';host='.$credentials['host'].';port='.$credentials['port'], $credentials['username'], $credentials['password']);
        }

        return $this->database;
    }
}
