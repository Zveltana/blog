<?php

namespace Application\Controllers\Post;

use Application\Common\Container;
use Exception;

class UpdatePost
{
    public function execute(): void
    {
        $postData = $_POST;
        $files = $_FILES;
        $session = $_SESSION;

        $container = new Container();
        $container->postRepository();
        $post = $container->postRepository()->getPost($postData['identifier']);

        if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($postData['token']) && $postData['token'] === $session['token']) {
            $post = $container->postRepository()->getPostById($postData['identifier']);

            if($postData['title'] !== $post->title || $postData['description'] !== $post->description || $postData['content'] !== $post->content || (!empty($files)))
            {
                $post->title = $postData['title'];
                $post->description = $postData['description'];
                $post->content = $postData['content'];

                $picture = $container->pictureVerifier()->verify();

                if ($picture !== array()) {
                    if (file_exists($post->picture)) {
                        unlink($post->picture);
                    }

                    $post->picture = $picture;

                    $container->postRepository()->updatePost($post);
                    $container->redirection()->execute('index.php?action=posts');
                }

                $message['verify_picture'] = 'Votre image n\'est pas conforme (format autorisé, gif, png, jpg, jpeg, svg).';

            }

            $errorMessage = sprintf('Aucune modification effectuée !');
        } else {
            throw new Exception('Jeton de sécurité périmé');
        }
        require('templates/updatePost.php');
    }
}