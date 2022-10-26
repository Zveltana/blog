<?php

namespace Application\Controllers\User;

use Application\Common\Container;

class DeleteUser
{
    public function execute(): void
    {
        $container = new Container();
        $container->userRepository();

        $user = $container->userRepository()->getUsers();


        $container->userRepository()->deleteUser($_GET['id']);

        $container->redirection()->execute('index.php?action=dashboard');
    }
}

