<?php

namespace Application\Controllers\User;

use Application\Controllers\Controllers;

class DeleteUser
{
    public function execute(): void
    {
        $controllers = new Controllers();
        $controllers->userRepository();

        $user = $controllers->userRepository()->getUsers();


        $controllers->userRepository()->deleteUser($_GET['id']);

        $controllers->redirection()->execute('index.php?action=dashboard');
    }
}

