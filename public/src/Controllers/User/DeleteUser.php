<?php

namespace Application\Controllers\User;

use Application\Lib\Redirect;
use Application\Model\Repository\CommentRepository;
use Application\Lib\DatabaseConnection;
use Application\Model\Repository\PostRepository;
use Application\Model\Repository\UsersRepository;

class DeleteUser
{
    public function execute(): void
    {
        $connection = new DatabaseConnection();
        $usersRepository = new UsersRepository($connection);

        $user = $usersRepository->getUsers();
        $redirection = new Redirect();


        $usersRepository->deleteUser($_GET['id']);

        $redirection->execute('index.php?action=dashboard');
    }
}

