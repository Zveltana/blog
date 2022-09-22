<?php
namespace Application\Controllers;

use Application\Model\Repository\PostRepository;
use Application\Lib\DatabaseConnection;

class Homepage
{
    public function execute()
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $posts = $postRepository->getPosts();

        require('templates/homepage.php');
    }
}
