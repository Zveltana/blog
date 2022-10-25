<?php

namespace Application\Controllers\Post;

use Application\Controllers\Controllers;

class Post
{
    function execute(string $identifier): void
    {
        $controllers = new Controllers();

        $controllers->postRepository();
        $post = $controllers->postRepository()->getPost($identifier);

        $controllers->userRepository();
        $user = $controllers->userRepository()->getUserById($post->author);

        $controllers->commentRepository();
        $comments = $controllers->commentRepository()->getCommentsByPost($identifier);

        $controllers->categoriesRepository();
        $category = $controllers->categoriesRepository()->getCategoryById($post->categoryId);

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
                $errors = [];
                $comment = null;

                if (empty($_POST['comment'])) {
                    $errors['comment'] = 'Veuillez remplir ce champ.';
                }

                $comment = htmlspecialchars($_POST['comment'], ENT_COMPAT);

                if (count($errors) === 0) {
                    $success = $controllers->commentRepository()->createComment($identifier, $_SESSION['LOGGED_USER_ID'], $comment);

                    if (!$success) {
                        $errorMessage = sprintf('Les informations envoyées ne permettent pas d\'ajouter le commentaire!');
                    } else {
                        $message = sprintf('Votre commentaire est en attente de validation par un administrateur.');
                    }
                }
            }
        }
        require('templates/post.php');
    }
}
