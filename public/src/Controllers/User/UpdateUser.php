<?php

namespace Application\Controllers\User;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\UsersRepository;
use Application\Lib\Redirect;

class UpdateUser
{
    function execute() {
        $postData = $_POST;
        $connection = new DatabaseConnection();
        $usersRepository = new UsersRepository($connection);
        $users = $usersRepository->getUsers();

        if ($postData['status']) {
            $user = $usersRepository->getUserById($_GET['id']);
            $user->setIsAdmin(true);
            $usersRepository->updateUser($user);

        }
        $redirection = new Redirect();
        $redirection->execute('index.php?action=dashboard');
    }
}