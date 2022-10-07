<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\PostRepository;
use Application\Lib\Redirect;

class UpdatePost
{
    function execute() {
        $postData = $_POST;
        $connection = new DatabaseConnection();
        $postRepository = new PostRepository($connection);
        $post = $postRepository->getPost($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = $postRepository->getPostById($_GET['id']);
            $redirection = new Redirect();


            if($postData['title'] !== $post->title || $postData['description'] !== $post->description || $postData['content'] !== $post->content)
            {
                $postRepository->updatePost($post);
                $redirection->execute('index.php?action=posts');
            }

            $errorMessage = sprintf('Aucune modification effectuée !');
        }
        require('templates/updatePost.php');
    }
}