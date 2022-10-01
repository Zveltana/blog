<?php
namespace Application\Controllers;

use Application\Model\Repository\CategoryRepository;
use Application\Model\Repository\PostRepository;
use Application\Lib\DatabaseConnection;

class Posts
{
    public function execute()
    {
        $connection = new DatabaseConnection();

        $categoriesRepository = new CategoryRepository();
        $categoriesRepository->connection = $connection;
        $categories = $categoriesRepository->getCategories();

        $postRepository = new PostRepository($connection);
        $posts = $postRepository->getPosts();

        require('templates/posts.php');
    }
}