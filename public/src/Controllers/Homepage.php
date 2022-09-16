<?php
namespace Application\Controllers\Homepage;

require_once('src/Model/post.php');

use Application\Model\Post\PostRepository;
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
