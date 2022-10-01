<?php

namespace Application\Model\Repository;

use Application\Lib\DatabaseConnection;
use Application\Model\Comment;

class CommentRepository
{
    private DatabaseConnection $connection;
    private UsersRepository $usersRepository;
    private PostRepository $postRepository;

    public function __construct(DatabaseConnection $connection, UsersRepository $usersRepository, PostRepository $postRepository)
    {
        $this->connection = $connection;
        $this->usersRepository = $usersRepository;
        $this->postRepository = $postRepository;
    }

    public function getCommentsByPost(string $post): array {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, comment, DATE_FORMAT(comment_date, '%d/%m/%Y') AS french_creation_date,is_enabled, user_id, post_id FROM comments WHERE post_id = ? ORDER BY id DESC"
        );

        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())){
            $author = $this->usersRepository->getUserById($row['user_id']);
            $postId = $this->postRepository->getPostById($row['post_id']);

            $comment = new Comment();
            $comment->title = $row['title'];
            $comment->author = $author;
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->identifier = $row['id'];
            $comment->IsEnabled = $row['is_enabled'];
            $comment->postId = $postId;

            $comments[] = $comment;
        }

        return $comments;
    }

    public function getComments(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, comment, DATE_FORMAT(comment_date, '%d/%m/%Y') AS french_creation_date, is_enabled, user_id, post_id FROM comments ORDER BY id DESC"
        );

        $comments = [];
        while (($row = $statement->fetch())){
            $author = $this->usersRepository->getUserById($row['user_id']);
            $postId = $this->postRepository->getPostById($row['post_id']);

            $comment = new Comment();
            $comment->title = $row['title'];
            $comment->author = $author;
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->identifier = $row['id'];
            $comment->IsEnabled = $row['is_enabled'];
            $comment->postId = $postId;

            $comments[] = $comment;
        }

        return $comments;
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

    public function checkComment (bool $IsEnabled, string $identifier): void {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE comments SET is_enabled = :is_enabled WHERE id = :id"
        );

        $statement->execute([
            'id' => $identifier,
            'is_enabled' => $IsEnabled,
        ]);
    }
}

