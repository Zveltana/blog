<?php

namespace Application\Model\Repository;

use Application\Lib\DatabaseConnection;
use Application\Model\Post;

class PostRepository
{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, description, content, picture, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_creation_date, category_id, user_id FROM posts ORDER BY creation_date DESC"
        );

        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new Post();
            $post->title = $row['title'];
            $post->description = $row['description'];
            $post->content = $row['content'];
            $post->picture = $row['picture'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->identifier = $row['id'];
            $post->categoryId = $row['category_id'];
            $post->author = $row['user_id'];

            $posts[] = $post;
        }

        return $posts;
    }

    public function getPost(string $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, description, content, picture, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_creation_date, category_id, user_id FROM posts WHERE id = ?"
        );


        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
        $post->title = $row['title'];
        $post->description = $row['description'];
        $post->content = $row['content'];
        $post->picture = $row['picture'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->identifier = $row['id'];
        $post->categoryId = $row['category_id'];
        $post->author = $row['user_id'];

        return $post;
    }

    public function getPostById(int $id): ?Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, description, content, picture, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_creation_date, category_id, user_id FROM posts WHERE id = :id"
        );

        $statement->execute(['id' => $id]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $post = new Post();
        $post->title = $row['title'];
        $post->description = $row['description'];
        $post->content = $row['content'];
        $post->picture = $row['picture'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->identifier = $row['id'];
        $post->categoryId = $row['category_id'];
        $post->author = $row['user_id'];

        return $post;
    }

    public function createPost(string $title, string $author, string $description, string $content, string $picture, int $category): bool
    {
        $statement = $this->connection->getConnection()->prepare("
        INSERT INTO posts(title, user_id, description, content, creation_date, picture, category_id) VALUES(?, ?, ?, ?, NOW(), ?, ?)
        ");

        $affectedLines = $statement->execute([$title, $author, $description, $content, $picture, $category]);

        return ($affectedLines > 0);
    }

    public function updatePost(Post $post): void
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE posts SET title = :title, description = :description, content = :content, picture = :picture, creation_date = NOW() WHERE id = :id "
        );

        $statement->execute([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'content' => $_POST['content'],
            'picture' => $_POST['picture'],
            'id' => $post->identifier,
        ]);
    }

    public function deletePost(string $identifier)
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM posts WHERE id = :id'
        );

        $statement->execute([
            'id' => $identifier,
        ]);
    }
}