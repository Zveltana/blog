<?php
namespace Application\Controllers\Comment;

use Application\Model\Repository\CommentRepository;
use Application\Lib\DatabaseConnection;
use Application\Model\Repository\UsersRepository;

class AddComment
{
    public function execute(string $post, array $input)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $author = null;
        $comment = null;

        $errors = [];

        if (!empty($input['author'])) {
            $author = $input['author'];
        } else {
            $errors['author'] = 'Veuillez remplir ce champ.';
        }

        if (!empty($input['comment'])) {
            $comment = $input['comment'];
        } else {
            $errors['comment'] = 'Veuillez remplir ce champ.';
        }

        if (count($errors) === 0) {
            $success = $commentRepository->createComment($post, $author, $comment);

            if (!$success) {
                $errorMessage = sprintf('Les informations envoyées ne permettent pas d\'ajouter le commentaire!');
            } else {
                header('Location: index.php?action=post&id=' . $post);
            }
        }

        require('templates/post.php');
    }
}
