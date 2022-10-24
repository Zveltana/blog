<?php

namespace Application\Controllers;

use Application\Lib\Redirect;
use Application\Model\Repository\PostRepository;
use Application\Lib\DatabaseConnection;
use Application\Model\Repository\UsersRepository;

class AddPost
{
    function execute(): void
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository($connection);
        $post = $postRepository->getPosts();

        $usersRepository = new UsersRepository($connection);

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
                $redirection = new Redirect();
                $title = strip_tags($_POST['title']);
                $description = strip_tags($_POST['description']);
                $content = strip_tags($_POST['content']);
                $picture = $_FILES['picture'];

                $fileInfo = pathinfo($picture['name']);
                $extension = $fileInfo['extension'];

                $move = sprintf("img/blog/%s.%s", md5(basename($picture['name'])), $extension);

                if (isset($picture) && $picture['error'] === 0)
                {
                    if ($picture['size'] <= 1000000)
                    {
                        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg'];
                        if (in_array($extension, $allowedExtensions, true))
                        {
                            move_uploaded_file($_FILES['picture']['tmp_name'], $move);
                        }
                    }
                }

                $success = $postRepository->createPost($title, $_SESSION['LOGGED_USER_ID'], $description, $content, $move, $_GET['id']);

                if (!$success) {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas d\'ajouter l\'article !');
                } else {
                    $message = sprintf('Votre commentaire est en attente de validation par un administrateur');
                    $redirection->execute('index.php?action=posts');
                }
            }
        }
        require('templates/addPost.php');
    }
}
