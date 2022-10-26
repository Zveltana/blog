<?php

namespace Application\Controllers\Comment;

use Application\Common\Container;

class DeleteComment
{
    public function execute(): void
    {
            $container = new Container();
            $container->userRepository();
            $container->postRepository();
            $post = $container->postRepository()->getPosts();
            $container->commentRepository();
            $comments = $container->commentRepository()->getComments();


            $container->commentRepository()->deleteComment($_GET['id']);

            $container->redirection()->execute('index.php?action=dashboard');
    }
}

