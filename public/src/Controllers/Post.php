<?php

namespace Application\Controllers\Post;

require_once ('src/Lib/DatabaseConnection.php');
require_once('src/Model/Post.php');
require_once ('src/Model/Comment.php');

use Application\Model\Repository\Post\PostRepository;
use Application\Model\Repository\Comment\CommentRepository;
use Application\lib\Database\DatabaseConnection;

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
