<?php

namespace Application\Controllers\User;

use Application\Common\Container;

class Logout {
    public function execute(){
        $container = new Container();

        session_destroy();

        setcookie(
            'LOGGED_USER',
            null,
            -1
        );

        $container->redirection()->execute('index.php');
    }
}