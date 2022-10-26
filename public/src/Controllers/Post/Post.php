<?php

namespace Application\Controllers\Post;

use Application\Common\Container;

class Post
{
    function execute(string $identifier): void
    {
        $container = new Container();

        $container->postRepository();
        $post = $container->postRepository()->getPost($identifier);

        $container->userRepository();
        $user = $container->userRepository()->getUserById($post->author);

        $container->commentRepository();
        $comments = $container->commentRepository()->getCommentsByPost($identifier);

        $container->categoriesRepository();
        $category = $container->categoriesRepository()->getCategoryById($post->categoryId);

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
                $errors = [];
                $comment = null;

                if (empty($_POST['comment'])) {
                    $errors['comment'] = 'Veuillez remplir ce champ.';
                }

                $comment = htmlspecialchars($_POST['comment'], ENT_COMPAT);

                if (count($errors) === 0) {
                    $success = $container->commentRepository()->createComment($identifier, $_SESSION['LOGGED_USER_ID'], $comment);

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
