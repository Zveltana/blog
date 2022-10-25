<?php

namespace Application\Controllers\User;

use Application\Controllers\Controllers;

class UpdateUser
{
    function execute() {
        $postData = $_POST;
        $controllers = new Controllers();
        $controllers->userRepository();
        $users = $controllers->userRepository()->getUsers();

        if ($postData['status']) {
            $user = $controllers->userRepository()->getUserById($_GET['id']);
            $user->setIsAdmin(true);
            $controllers->userRepository()->updateUser($user);

        }
        $controllers->redirection()->execute('index.php?action=dashboard');
    }
}