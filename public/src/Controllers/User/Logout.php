<?php

namespace Application\Controllers\User;

class Logout {
    public function execute(){
        session_destroy();

        setcookie(
            'LOGGED_USER',
            null,
            -1
        );

        header('Location: index.php');
    }
}