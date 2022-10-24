<?php

namespace Application\Controllers;

use Application\Lib\Redirect;
use Application\Lib\DatabaseConnection;
use Application\Model\Repository\CommentRepository;
use Application\Model\Repository\UsersRepository;
use Application\Model\Repository\PostRepository;
use Exception;

class DeletePost
{
    public function execute(): void
    {
        $connection = new DatabaseConnection();
        $postRepository = new PostRepository($connection);
        $userRepository = new UsersRepository($connection);
        $commentRepository = new CommentRepository($connection, $userRepository, $postRepository);

        $redirection = new Redirect();

        if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {


            $post = $postRepository->getPostById($_POST['identifier']);

            $commentRepository->deleteCommentByPost($_POST['identifier']);
            $postRepository->deletePost($_POST['identifier']);

            if (file_exists($post->picture)) {
                unlink($post->picture);
            }

            $redirection->execute('index.php?action=posts');
        } else {
            throw new Exception('Jeton de sécurité périmé');
        }
    }
}

