<?php

namespace Application\Controllers\Post;

use Application\Common\Container;
use Application\Verifier\PictureVerifier;
use Exception;

class UpdatePost
{
    public function execute(): void
    {
        $postData = $_POST;
        $get = $_GET;
        $files = $_FILES;
        $session = $_SESSION;

        $container = new Container();
        $container->postRepository();
        $post = $container->postRepository()->getPost($get['id']);

        if ('POST' === $_SERVER['REQUEST_METHOD'])
        {
            if(isset($postData['token']) && $postData['token'] === $session['token']) {
                $post = $container->postRepository()->getPostById($get['id']);

                $picture = $container->pictureVerifier()->verify();

                $errors = [];
                $title = null;

                $fields = [
                    'title',
                    'description',
                    'content',
                ];

                foreach ($fields as $field) {
                    if (empty($postData[$field])) {
                        $errors[$field] = 'Veuillez remplir ce champ.';
                    }
                }

                if ($postData['title'] === $post->title && $postData['description'] && $post->description && $postData['content'] === $post->content && $picture === PictureVerifier::NOTHING)
                {
                    $errors['nothing']= 'Rien n\'a été modifié !';
                }

                if (count($errors) === 0) {
                    $message = [];
                    $post->title = $postData['title'];
                    $post->description = $postData['description'];
                    $post->content = $postData['content'];

                    if (isset($_FILES['picture']) && $picture) {

                        $upload = $container->pictureVerifier()->upload();

                        if (file_exists($post->picture)) {
                            unlink($post->picture);
                        }
                        $post->picture = $upload;
                    }

                    if($picture !== PictureVerifier::NOT_VALID) {
                        $container->postRepository()->updatePost($post);
                        $container->redirection()->execute('index.php?action=posts');
                    }

                    $message['verify_picture'] = 'Votre image n\'est pas conforme (format autorisé, gif, png, jpg, jpeg, svg).';
                }
            } else {
                throw new Exception('Jeton de sécurité périmé');
            }
        }
        require('templates/updatePost.php');
    }
}