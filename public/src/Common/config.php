<?php

$pshConfig = new \Platformsh\ConfigReader\Config();
if (!$pshConfig->isValidPlatform()) {
    define("DB_HOST", "localhost");
    define("DB_NAME", "blog_php");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
} else {
    $credentials = $pshConfig->credentials('database');
    define("DB_HOST", $credentials['host']);
    define("DB_NAME", $credentials['path']);
    define("DB_USERNAME", $credentials['username']);
    define("DB_PASSWORD", $credentials['password']);
}