<?php

namespace Application\Controllers\User;

use Application\Common\Container;

class DeleteUser
{
    public function execute(): void
    {
        $get = $_GET;
        $container = new Container();
        $container->userRepository();

        $user = $container->userRepository()->getUsers();


        $container->userRepository()->deleteUser($get['id']);

        $container->redirection()->execute('index.php?action=dashboard');
    }
}

