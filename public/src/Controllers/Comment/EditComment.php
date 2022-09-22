<?php

namespace Application\Controllers\Comment;

use Application\Model\Repository\CommentRepository;
use Application\lib\DatabaseConnection;

class EditComment
{
    public function execute(string $identifier, ?array $input): void
    {
        if ($input !== null) {
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
            $success = $commentRepository->editComment($identifier, $author, $comment);

            if (!$success) {
                throw new \Exception('Impossible de modifier le commentaire');
            } else {
                header('Location: index.php?action=editComment&id=' . $identifier);
            }
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($identifier);

        if($comment === null) {
            throw new \Exception('Le commentaire $identifier n\'existe pas');
        }

        require('templates/editComment.php');
    }
}

