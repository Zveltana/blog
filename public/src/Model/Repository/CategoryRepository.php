<?php

namespace Application\Model\Repository;

use Application\Model\Category;
use Application\Lib\DatabaseConnection;

class CategoryRepository
{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function getCategories(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, name FROM categories"
        );

        $categories = [];
        while (($row = $statement->fetch())) {
            $category = new Category();
            $category->name = $row['name'];
            $category->identifier = $row['id'];

            $categories[] = $category;
        }

        return $categories;
    }

    public function getCategory(string $identifier): Category
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, name FROM categories"
        );

        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $category = new Category();
        $category->name = $row['name'];
        $category->identifier = $row['id'];

        return $category;
    }

    public function getCategoryById(int $identifier): ?Category
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, name FROM categories WHERE id = :id"
        );

        $statement->execute(['id' => $identifier]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $category = new Category();
        $category->name = $row['name'];
        $category->identifier = $row['id'];

        return $category;
    }
}
