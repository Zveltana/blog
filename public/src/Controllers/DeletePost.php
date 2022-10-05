<?php

namespace Application\Controllers;

use Application\Lib\Redirect;
use Application\Lib\DatabaseConnection;
use Application\Model\Repository\PostRepository;

class DeletePost
{
    public function execute(): void
    {
        $connection = new DatabaseConnection();
        $postRepository = new PostRepository($connection);

        $post = $postRepository->getPosts();
        $redirection = new Redirect();


        $postRepository->deletePost($_GET['id']);

        $redirection->execute('index.php?action=posts');
    }
}

