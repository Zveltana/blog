<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\CommentRepository;
use Application\Model\Repository\PostRepository;
use Application\Model\Repository\UsersRepository;

class Dashboard
{
    function execute()
    {
        $connection = new DatabaseConnection();

        $usersRepository = new UsersRepository($connection);
        $users = $usersRepository->getUsers();

        $postRepository = new PostRepository($connection);
        $posts = $postRepository->getPosts();

        $commentRepository = new CommentRepository($connection, $usersRepository, $postRepository);
        $comments = $commentRepository->getComments();

        require('templates/dashboard.php');
    }
}
