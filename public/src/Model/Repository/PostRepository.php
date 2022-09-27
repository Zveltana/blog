<?php

namespace Application\Model\Repository;

use Application\Lib\DatabaseConnection;
use Application\Model\Post;

class PostRepository
{
    public DatabaseConnection $connection;

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, description, content, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_creation_date, category_id FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
        );

        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new Post();
            $post -> title = $row['title'];
            $post -> description = $row['description'];
            $post -> content = $row['content'];
            $post -> frenchCreationDate = $row['french_creation_date'];
            $post -> identifier = $row['id'];
            $post -> categoryId = $row['category_id'];

            $posts[] = $post;
        }

        return $posts;
    }

    public function getPost(string $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, description, content, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_creation_date, category_id FROM posts WHERE id = ?"
        );


        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
        $post -> title = $row['title'];
        $post -> description = $row['description'];
        $post -> content = $row['content'];
        $post -> frenchCreationDate = $row['french_creation_date'];
        $post -> identifier = $row['id'];
        $post -> categoryId = $row['category_id'];

        return $post;
    }
}