<?php

namespace Application\Controllers\Post;

use Application\Common\Container;
use Exception;

class UpdatePost
{
    function execute(): void
    {
        $postData = $_POST;
        $container = new Container();
        $container->postRepository();
        $post = $container->postRepository()->getPost($postData['identifier']);

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']){
                $post = $container->postRepository()->getPostById($postData['identifier']);

                if($postData['title'] !== $post->title || $postData['description'] !== $post->description || $postData['content'] !== $post->content || !empty($_FILES))
                {
                    $post->title = $postData['title'];
                    $post->description = $postData['description'];
                    $post->content = $postData['content'];

                    $picture = $container->pictureVerifier()->verify();

                    if ($picture === array()) {
                        $message['verify_picture'] = 'Votre image n\'est pas conforme (format autorisé, gif, png, jpg, jpeg, svg).';
                    } else {
                        if (file_exists($post->picture)) {
                            unlink($post->picture);
                        }
                        $post->picture = $picture;

                        $container->postRepository()->updatePost($post);
                        $container->redirection()->execute('index.php?action=posts');
                    }
                }

                $errorMessage = sprintf('Aucune modification effectuée !');
            } else {
                throw new Exception('Jeton de sécurité périmé');
            }

        }
        require('templates/updatePost.php');
    }
}