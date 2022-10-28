<?php

namespace Application\Controllers\Post;

use Application\Common\Container;

class Post
{
    function execute(string $identifier): void
    {
        $server = $_SERVER;
        $session = $_SESSION;
        $postData = $_POST;

        $container = new Container();

        $container->postRepository();
        $post = $container->postRepository()->getPost($identifier);

        $container->userRepository();
        $user = $container->userRepository()->getUserById($post->author);

        $container->commentRepository();
        $comments = $container->commentRepository()->getCommentsByPost($identifier);

        $container->categoriesRepository();
        $category = $container->categoriesRepository()->getCategoryById($post->categoryId);

        if (('POST' === $server['REQUEST_METHOD']) && isset($postData['token']) && $postData['token'] === $session['token']) {
            $errors = [];
            $comment = null;

            if (empty($postData['comment'])) {
                $errors['comment'] = 'Veuillez remplir ce champ.';
            }

            $comment = htmlspecialchars($postData['comment'], ENT_COMPAT);

            if (count($errors) === 0) {
                $success = $container->commentRepository()->createComment($identifier, $_SESSION['LOGGED_USER_ID'], $comment);

                if (!$success) {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas d\'ajouter le commentaire!');
                }
                $message = sprintf('Votre commentaire est en attente de validation par un administrateur.');
            }
        }
        require('templates/post.php');
    }
}
