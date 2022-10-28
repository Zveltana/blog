<?php

namespace Application\Controllers\Post;

use Application\Model\Repository\UsersRepository;
use Application\Common\Container;

class AddPost
{
    public function execute(): void
    {
        $server = $_SERVER;
        $postdata = $_POST;
        $files = $_FILES;
        $container = new Container();

        $posts = $container->postRepository();
        $posts->getPosts();

        if ('POST' === $server['REQUEST_METHOD']) {
            $errors = [];
            $title = null;
            $comment = null;

            $fields = [
                'title',
                'description',
                'content',
                'picture',
            ];

            foreach ($fields as $field)
            {
                if (empty($postdata[$field])) {
                    $errors[$field] = 'Veuillez remplir ce champ.';
                }
            }

            if (count($errors) === 0) {
                $message = [];

                $picture = $container->pictureVerifier()->verify();

                if ($picture === array()) {
                    $message['verify_picture'] = 'Votre image n\'est pas conforme (format autorisé, gif, png, jpg, jpeg, svg).';
                } else {
                    $title = strip_tags($_POST['title']);
                    $author = $_SESSION['LOGGED_USER_ID'];
                    $description = strip_tags($_POST['description']);
                    $content = strip_tags($_POST['content']);
                    $category = $_GET['id'];

                    $success = $posts->createPost($title, $author, $description, $content, $picture, $category);

                    $message = sprintf('Votre commentaire est en attente de validation par un administrateur');
                    $container->redirection()->execute('index.php?action=posts');
                }
            }
        }
        require('templates/addPost.php');
    }
}
