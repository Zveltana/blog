<?php

namespace Application\Controllers;

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

            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description'], ENT_COMPAT);
            $content = htmlspecialchars($_POST['content'], ENT_COMPAT);
            $picture = $_FILES['picture'];

            if (count($errors) === 0) {
                if (isset($picture) && $picture['error'] === 0)
                {
                    if ($picture['size'] <= 1000000)
                    {
                        $fileInfo = pathinfo($picture['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                        if (in_array($extension, $allowedExtensions, true))
                        {
                            move_uploaded_file($_FILES['picture']['tmp_name'], 'img/blog/' . basename($picture['name']));
                            echo "L'envoi a bien été effectué !";
                            var_dump($fileInfo);

                        }
                    }
                }

                $success = $postRepository->createPost($title, $_SESSION['LOGGED_USER_ID'], $description, $content, $_FILES['picture']['name'], $_GET['id']);

                if (!$success) {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas d\'ajouter l\'article !');
                } else {
                    $message = sprintf('Votre commentaire est en attente de validation par un administrateur');
                    header('Location: index.php?action=posts');
                }
            }
        }
        require('templates/addPost.php');
    }
}
