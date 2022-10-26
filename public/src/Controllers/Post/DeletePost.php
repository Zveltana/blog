<?php

namespace Application\Controllers\Post;

use Application\Common\Container;
use Exception;

class DeletePost
{
    public function execute(): void
    {
        $container = new Container();

        $container->postRepository();
        $container->userRepository();
        $container->commentRepository();

        if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {


            $post = $container->postRepository()->getPostById($_POST['identifier']);

            $container->commentRepository()->deleteCommentByPost($_POST['identifier']);
            $container->postRepository()->deletePost($_POST['identifier']);

            if (file_exists($post->picture)) {
                unlink($post->picture);
            }

            $container->redirection()->execute('index.php?action=posts');
        } else {
            throw new Exception('Jeton de sécurité périmé');
        }
    }
}

