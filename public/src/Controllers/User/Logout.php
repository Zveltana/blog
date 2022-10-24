<?php

namespace Application\Controllers\User;

use Application\Lib\Redirect;

class Logout {
    public function execute(){
        $redirection = new Redirect();
        session_destroy();

        setcookie(
            'LOGGED_USER',
            null,
            -1
        );

        $redirection->execute('index.php');
    }
}