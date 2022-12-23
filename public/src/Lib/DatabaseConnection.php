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

        if ($this->database === null) {
            $this->database = new \PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.$credentials['port'], DB_USERNAME, DB_PASSWORD);
        }

        return $this->database;
    }
}
