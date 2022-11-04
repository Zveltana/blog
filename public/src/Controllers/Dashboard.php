<?php

namespace Application\Controllers;

use Application\Common\Container;

class Dashboard
{
    function execute(): void
    {
        $container = new Container();

        $container->userRepository();
        $users = $container->userRepository()->getUsers();

        $container->postRepository();
        $posts = $container->postRepository()->getPosts();

        $container->commentRepository();
        $comments = $container->commentRepository()->getComments();

        require('templates/dashboard.php');
    }
}
