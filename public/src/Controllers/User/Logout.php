<?php

namespace Application\Controllers\User;

use Application\Controllers\Controllers;

class Logout {
    public function execute(){
        $controllers = new Controllers();

        session_destroy();

        setcookie(
            'LOGGED_USER',
            null,
            -1
        );

        $controllers->redirection()->execute($_SERVER['HTTP_REFERER']);
    }
}