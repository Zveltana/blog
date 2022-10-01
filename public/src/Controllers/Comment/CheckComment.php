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

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;
            $connection = new DatabaseConnection();
            $usersRepository = new UsersRepository($connection);
            $postRepository = new PostRepository($connection);
            $post = $postRepository->getPosts();
            $commentRepository = new CommentRepository($connection, $usersRepository, $postRepository);
            $comments = $commentRepository->getComments();
            $redirection = new Redirect();

            if ($postData['status'] === 'false') {
                $errors['status'] = 'Pas de modification effectuée.';
            }

            if (count($errors) === 0) {
                if ($postData['status'] === 'true') {
                    $commentRepository->checkComment($postData['status'], $_GET['id']);

                    $redirection->execute('index.php?action=dashboard');
                }
            }
            $redirection->execute('index.php?action=dashboard');
        }
    }
}