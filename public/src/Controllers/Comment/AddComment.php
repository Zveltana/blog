<?php
namespace Application\Controllers\Comment;

use Application\Model\Repository\CommentRepository;
use Application\lib\DatabaseConnection;

class AddComment
{
    public function execute(string $post, array $input)
    {
        $author = null;
        $comment = null;

        if (!empty($input['author']) && !empty($input['Comment'])) {
            $author = $input['author'];
            $comment = $input['Comment'];
        } else {
            throw new \Exception('Les données du formulaire sont invalide');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($post, $author, $comment);

        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le commentaire');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }
}
