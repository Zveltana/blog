<?php

namespace Application\Model\Post;

require_once ('src/Lib/DatabaseConnection.php');

use Application\lib\Database\DatabaseConnection;

class Post {
    public string $title;
    public string $content;
    public string $frenchCreationDate;
    public string $identifier;
}

class PostRepository {
    public DatabaseConnection $connection;

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
        );

        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new Post();
            $post -> title = $row['title'];
            $post -> content = $row['content'];
            $post -> frenchCreationDate = $row['french_creation_date'];
            $post -> identifier = $row['id'];

            $posts[] = $post;
        }

        return $posts;
    }

    public function getPost(string $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_creation_date FROM posts WHERE id = ?"
        );

        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
        $post -> title = $row['title'];
        $post -> content = $row['content'];
        $post -> frenchCreationDate = $row['french_creation_date'];
        $post -> identifier = $row['id'];

        return $post;
    }
}
