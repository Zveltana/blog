<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\CategoryRepository;
use Application\Model\Repository\PostRepository;

class Category {
    function execute()
    {
        $connection = new DatabaseConnection();

        $categoriesRepository = new CategoryRepository();
        $categoriesRepository->connection = new DatabaseConnection();
        $categories = $categoriesRepository->getCategories();

        $postRepository = new PostRepository($connection);
        $post = $postRepository->getPosts();

        require('templates/homepage.php');
    }
}
