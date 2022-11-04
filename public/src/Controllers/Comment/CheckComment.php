<?php

namespace Application\Controllers\Comment;

use Application\Common\Container;

class CheckComment
{
    function execute() {
        $get = $_GET;

        $container = new Container();
        $container->userRepository();
        $container->postRepository();
        $container->commentRepository();
        $comments = $container->commentRepository()->getComments();
        $container->redirection();


        $container->commentRepository()->checkComment($get['id']);

        $container->redirection()->execute('index.php?action=dashboard');
    }
}