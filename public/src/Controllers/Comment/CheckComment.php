<?php

namespace Application\Controllers\Comment;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\CommentRepository;
use Application\Model\Repository\PostRepository;
use Application\Model\Repository\UsersRepository;
use Application\Lib\Redirect;

class CheckComment
{
    function execute() {
        $connection = new DatabaseConnection();
        $usersRepository = new UsersRepository($connection);
        $postRepository = new PostRepository($connection);
        $post = $postRepository->getPosts();
        $commentRepository = new CommentRepository($connection, $usersRepository, $postRepository);
        $comments = $commentRepository->getComments();
        $redirection = new Redirect();


        $commentRepository->checkComment($_GET['id']);

        $redirection->execute('index.php?action=dashboard');
    }
}