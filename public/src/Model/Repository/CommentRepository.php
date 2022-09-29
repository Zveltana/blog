<?php

namespace Application\Model\Repository;

use Application\Lib\DatabaseConnection;
use Application\Model\Comment;

class CommentRepository
{
    private DatabaseConnection $connection;
    private UsersRepository $usersRepository;

    public function __construct(DatabaseConnection $connection, UsersRepository $usersRepository)
    {
        $this->connection = $connection;
        $this->usersRepository = $usersRepository;
    }

    public function getComments(string $post): array {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, comment, DATE_FORMAT(comment_date, '%d/%m/%Y') AS french_creation_date, user_id, post_id FROM comments WHERE post_id = ? ORDER BY id DESC"
        );

        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())){
            $author = $this->usersRepository->getUserById($row['user_id']);

            $comment = new Comment();
            $comment->title = $row['title'];
            $comment->author = $author;
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->identifier = $row['id'];
            $comment->postId = $row['post_id'];

            $comments[] = $comment;
        }

        return $comments;
    }

    public function getComment(string $identifier): ?Comment
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, comment, DATE_FORMAT(comment_date, '%d/%m/%Y') AS french_creation_date, user_id, post_id FROM comments WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $comment = new Comment();
        $comment->identifier = $row['id'];
        $comment->title = $row['title'];
        $comment->author = $row['user_id'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->comment = $row['comment'];
        $comment->postId = $row['post_id'];

        return $comment;
    }

    public function createComment (string $post, string $author, string $title, string $comment): bool {
        $statement = $this->connection->getConnection()->prepare("
        INSERT INTO comments(post_id, user_id, title, comment, comment_date) VALUES(?, ?, ?, ?, NOW())
        ");

        $affectedLines = $statement->execute([$post, $author, $title, $comment]);

        return ($affectedLines > 0);
    }

    public function editComment (string $identifier, string $title, string $comment): bool {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET title = ?, comment = ? WHERE id = ?'
        );

        $affectedLines = $statement->execute([$title, $comment, $identifier]);

        return($affectedLines > 0);
    }
}

