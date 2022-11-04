<?php

namespace Application\Controllers\Post;

use Application\Common\Container;
use Exception;

class DeletePost
{
    public function execute(): void
    {
        $postData = $_POST;
        $session = $_SESSION;

        $container = new Container();

        $container->postRepository();
        $container->userRepository();
        $container->commentRepository();

        if($postData['token'] && $postData['token'] === $session['token']) {

            $post = $container->postRepository()->getPostById($postData['identifier']);

            $container->commentRepository()->deleteCommentByPost($postData['identifier']);
            $container->postRepository()->deletePost($postData['identifier']);

            if (file_exists($post->picture)) {
                unlink($post->picture);
            }

            $container->redirection()->execute('index.php?action=posts');
        }
        throw new Exception('Jeton de sécurité périmé');
    }
}

