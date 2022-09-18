<?php
namespace Application\Controllers\Homepage;

require_once('src/Model/Repository/PostRepository.php');

use Application\Model\Repository\Post\PostRepository;
use Application\lib\Database\DatabaseConnection;

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
