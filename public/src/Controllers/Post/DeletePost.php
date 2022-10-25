<?php

namespace Application\Controllers\Post;

use Application\Controllers\Controllers;
use Exception;

class DeletePost
{
    public function execute(): void
    {
        $controllers = new Controllers();

        $controllers->postRepository();
        $controllers->userRepository();
        $controllers->commentRepository();

        if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {


            $post = $controllers->postRepository()->getPostById($_POST['identifier']);

            $controllers->commentRepository()->deleteCommentByPost($_POST['identifier']);
            $controllers->postRepository()->deletePost($_POST['identifier']);

            if (file_exists($post->picture)) {
                unlink($post->picture);
            }

            $controllers->redirection()->execute('index.php?action=posts');
        } else {
            throw new Exception('Jeton de sécurité périmé');
        }
    }
}

