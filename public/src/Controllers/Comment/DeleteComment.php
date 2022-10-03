<?php

namespace Application\Controllers\Comment;

use Application\Lib\Redirect;
use Application\Model\Repository\CommentRepository;
use Application\Lib\DatabaseConnection;
use Application\Model\Repository\PostRepository;
use Application\Model\Repository\UsersRepository;

class DeleteComment
{
    public function execute(): void
    {
            $connection = new DatabaseConnection();
            $usersRepository = new UsersRepository($connection);
            $postRepository = new PostRepository($connection);
            $post = $postRepository->getPosts();
            $commentRepository = new CommentRepository($connection, $usersRepository, $postRepository);
            $comments = $commentRepository->getComments();
            $redirection = new Redirect();


            $commentRepository->deleteComment($_GET['id']);

            $redirection->execute('index.php?action=dashboard');
    }
}

