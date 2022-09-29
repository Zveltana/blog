<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\UsersRepository;

class Dashboard
{
    function execute()
    {
        $connection = new DatabaseConnection();

        $usersRepository = new UsersRepository($connection);
        $users = $usersRepository->getUsers();

        require('templates/dashboard.php');
    }
}
