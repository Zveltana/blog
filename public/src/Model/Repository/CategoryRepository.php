<?php

namespace Application\Model\Repository;

use Application\Model\Category;
use Application\Lib\DatabaseConnection;

class CategoryRepository
{
    public DatabaseConnection $connection;

    public function getCategories(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, name FROM categories"
        );

        $categories = [];
        while (($row = $statement->fetch())) {
            $category = new Category();
            $category -> name = $row['name'];
            $category -> identifier = $row['id'];

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
        $category -> name = $row['name'];
        $category -> identifier = $row['id'];

        return $category;
    }
}
