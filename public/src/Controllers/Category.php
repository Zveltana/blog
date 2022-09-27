<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\CategoryRepository;
use Application\Model\Repository\PostRepository;

class Category {
    function execute(string $identifier)
    {
        $connection = new DatabaseConnection();

        $categoriesRepository = new CategoryRepository();
        $categoriesRepository->connection = new DatabaseConnection();
        $categories = $categoriesRepository->getCategories();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPosts($identifier);

        require('templates/homepage.php');
    }
}
