<?php

namespace Application\Controllers;

use Application\Model\Repository\PostRepository;
use Application\Model\Repository\CommentRepository;
use Application\Lib\DatabaseConnection;
use Application\Model\Repository\UsersRepository;
use Application\Model\Repository\CategoryRepository;

class Post
{
    function execute(string $identifier): void
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository($connection);
        $post = $postRepository->getPost($identifier);

        $usersRepository = new UsersRepository($connection);
        $user = $usersRepository->getUserById($post->author);

        $commentRepository = new CommentRepository($connection, $usersRepository, $postRepository);
        $comments = $commentRepository->getCommentsByPost($identifier);

        $categoriesRepository = new CategoryRepository();
        $categoriesRepository->connection = $connection;
        $category = $categoriesRepository->getCategoryById($post->categoryId);

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $errors = [];
            $comment = null;

            if (empty($_POST['comment'])) {
                $errors['comment'] = 'Veuillez remplir ce champ.';
            }

            $comment = htmlspecialchars($_POST['comment'], ENT_COMPAT);

            if (count($errors) === 0) {
                $success = $commentRepository->createComment($identifier, $_SESSION['LOGGED_USER_ID'], $comment);

                if (!$success) {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas d\'ajouter le commentaire!');
                } else {
                    $message = sprintf('Votre commentaire est en attente de validation par un administrateur');
                    header('Location: index.php?action=post&id=' . $identifier);
                }
            }
        }
        require('templates/post.php');
    }
}
