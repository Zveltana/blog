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
            "SELECT id, comment, DATE_FORMAT(comment_date, '%d/%m/%Y') AS french_creation_date,is_enabled, user_id, post_id FROM comments WHERE post_id = ? ORDER BY id DESC"
        );

        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())){
            $author = $this->usersRepository->getUserById($row['user_id']);
            $postId = $this->postRepository->getPostById($row['post_id']);

            $comment = new Comment();
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
            "SELECT id, comment, DATE_FORMAT(comment_date, '%d/%m/%Y') AS french_creation_date, is_enabled, user_id, post_id FROM comments ORDER BY id DESC"
        );

        $comments = [];
        while (($row = $statement->fetch())){
            $author = $this->usersRepository->getUserById($row['user_id']);
            $postId = $this->postRepository->getPostById($row['post_id']);

            $comment = new Comment();
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

    public function createComment (string $post, string $author, string $comment): bool {
        $statement = $this->connection->getConnection()->prepare("
        INSERT INTO comments(post_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())
        ");

        $affectedLines = $statement->execute([strip_tags($post), strip_tags($author), strip_tags($comment)]);

        return ($affectedLines > 0);
    }

    public function deleteComment (string $identifier): void {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM comments WHERE id = :id'
        );

        $statement->execute([
            'id' => $identifier,
        ]);
    }

    public function deleteCommentByPost (string $post): void {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM comments WHERE post_id = :post_id'
        );

        $statement->execute([
            'post_id' => $post,
        ]);
    }

    public function checkComment (string $identifier): void {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE comments SET is_enabled = true WHERE id = :id"
        );

        $statement->execute([
            'id' => $identifier,
        ]);
    }
}

