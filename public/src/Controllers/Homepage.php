<?php
namespace Application\Controllers;

use Application\Model\Repository\CategoryRepository;
use Application\Model\Repository\PostRepository;
use Application\Lib\DatabaseConnection;

class Homepage
{
    public function execute()
    {
        $categoriesRepository = new CategoryRepository();
        $categoriesRepository->connection = new DatabaseConnection();
        $categories = $categoriesRepository->getCategories();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $posts = $postRepository->getPosts();

        require('templates/homepage.php');
    }
}
