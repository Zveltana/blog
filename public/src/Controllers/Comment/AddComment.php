<?php
namespace Application\Controllers\Comment\Add;

require_once('src/Model/Comment.php');
require_once ('src/Lib/DatabaseConnection.php');

use Application\Model\Repository\Comment\CommentRepository;
use Application\lib\Database\DatabaseConnection;

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
