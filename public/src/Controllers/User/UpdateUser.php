<?php

namespace Application\Controllers\User;

use Application\Common\Container;

class UpdateUser
{
    function execute() {
        $postData = $_POST;
        $container = new Container();
        $container->userRepository();
        $users = $container->userRepository()->getUsers();

        if ($postData['status']) {
            $user = $container->userRepository()->getUserById($_GET['id']);
            $user->setIsAdmin(true);
            $container->userRepository()->updateUser($user);

        }
        $container->redirection()->execute('index.php?action=dashboard');
    }
}