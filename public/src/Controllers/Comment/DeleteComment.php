<?php

namespace Application\Controllers\Comment;

use Application\Controllers\Controllers;

class DeleteComment
{
    public function execute(): void
    {
            $controllers = new Controllers();
            $controllers->userRepository();
            $controllers->postRepository();
            $post = $controllers->getPosts();
            $controllers->commentRepository();
            $comments = $controllers->commentRepository()->getComments();


            $controllers->commentRepository()->deleteComment($_GET['id']);

            $controllers->redirection()->execute('index.php?action=dashboard');
    }
}

