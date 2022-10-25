<?php

namespace Application\Controllers\Post;

use Application\Model\Repository\UsersRepository;
use Application\Controllers\Controllers;

class AddPost
{
    public function execute(): void
    {
        $controllers = new Controllers();

        $controllers->getPosts();

        $usersRepository = new UsersRepository($controllers->connection());

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

                $controllers->verify_picture();

                if ($controllers->verify_picture() === array()) {
                    $message['verify_picture'] = 'Votre image n\'est pas conforme (format autorisé, gif, png, jpg, jpeg, svg).';
                } else {
                    $success = $controllers->createPost();

                    if (!$success) {
                        $errorMessage = sprintf('Les informations envoyées ne permettent pas d\'ajouter l\'article !');
                    } else {
                        $message = sprintf('Votre commentaire est en attente de validation par un administrateur');
                        $controllers->redirection()->execute('index.php?action=posts');
                    }
                }
            }
        }
        require('templates/addPost.php');
    }
}
