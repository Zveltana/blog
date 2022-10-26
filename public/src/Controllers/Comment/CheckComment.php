<?php

namespace Application\Controllers\Comment;

use Application\Common\Container;

class CheckComment
{
    function execute() {
        $container = new Container();
        $container->userRepository();
        $container->postRepository();
        $post = $container->postRepository()->getPosts();
        $container->commentRepository();
        $comments = $container->commentRepository()->getComments();
        $container->redirection();


        $container->commentRepository()->checkComment($_GET['id']);

        $container->redirection()->execute('index.php?action=dashboard');
    }
}