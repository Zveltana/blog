<?php

namespace Application\Controllers;

use Application\Model\Repository\PostRepository;
use Application\Model\Repository\CommentRepository;
use Application\lib\DatabaseConnection;

class Post
{
    function execute(string $identifier)
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($identifier);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getComments($identifier);

        require('templates/Post.php');
    }
}
