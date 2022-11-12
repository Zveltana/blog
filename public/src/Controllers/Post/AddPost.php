<?php

namespace Application\Controllers\Post;

use Application\Model\Repository\UsersRepository;
use Application\Common\Container;

class AddPost
{
    public function execute(): void
    {
        $server = $_SERVER;
        $postData = $_POST;
        $session = $_SESSION;
        $get = $_GET;
        $files = $_FILES;
        $container = new Container();

        $posts = $container->postRepository();
        $posts->getPosts();

        if ('POST' === $server['REQUEST_METHOD']) {
            $errors = [];
            $title = null;

            $fields = [
                'title',
                'description',
                'content',
            ];

            foreach ($fields as $field)
            {
                if (empty($postData[$field])) {
                    $errors[$field] = 'Veuillez remplir ce champ.';
                }
            }

            if (empty($_FILES['picture']['name'])) {
                $errors['picture'] = 'Veuillez remplir ce champ.';
            }

            if (count($errors) === 0) {
                $message = [];

                $picture = $container->pictureVerifier()->verify();

                if ($picture === array()) {
                    $message['verify_picture'] = 'Votre image n\'est pas conforme (format autorisé, gif, png, jpg, jpeg, svg).';
                } else {
                    $upload = $container->pictureVerifier()->upload();
                    $title = strip_tags($postData['title']);
                    $author = $session['LOGGED_USER_ID'];
                    $description = strip_tags($postData['description']);
                    $content = strip_tags($postData['content']);
                    $category = $get['id'];

                    $posts->createPost($title, $author, $description, $content, $upload, $category);

                    $message = sprintf('Votre commentaire est en attente de validation par un administrateur');
                    $container->redirection()->execute('index.php?action=posts');
                }
            }
        }
        require('templates/addPost.php');
    }
}
