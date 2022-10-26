<?php

namespace Application\Controllers\Post;

use Application\Model\Repository\UsersRepository;
use Application\Common\Container;

class AddPost
{
    public function execute(): void
    {
        $container = new Container();

        $posts = $container->postRepository();
        $posts->getPosts();

        $usersRepository = new UsersRepository($container->connection());

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $errors = [];
            $title = null;
            $comment = null;
            if (empty($_POST['title'])) {
                $errors['title'] = 'Veuillez remplir ce champ.';
            }
            if (empty($_POST['description'])) {
                $errors['description'] = 'Veuillez remplir ce champ.';
            }
            if (empty($_POST['content'])) {
                $errors['content'] = 'Veuillez remplir ce champ.';
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
                    $title = strip_tags($_POST['title']);
                    $author = $_SESSION['LOGGED_USER_ID'];
                    $description = strip_tags($_POST['description']);
                    $content = strip_tags($_POST['content']);
                    $category = $_GET['id'];

                    $success = $posts->createPost($title, $author, $description, $content, $picture, $category);

                    if (!$success) {
                        $errorMessage = sprintf('Les informations envoyées ne permettent pas d\'ajouter l\'article !');
                    } else {
                        $message = sprintf('Votre commentaire est en attente de validation par un administrateur');
                        $container->redirection()->execute('index.php?action=posts');
                    }
                }
            }
        }
        require('templates/addPost.php');
    }
}
