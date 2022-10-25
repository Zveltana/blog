<?php

namespace Application\Controllers;

class Dashboard
{
    function execute(): void
    {
        $controllers = new Controllers();

        $controllers->userRepository();
        $users = $controllers->userRepository()->getUsers();

        $controllers->postRepository();
        $posts = $controllers->postRepository()->getPosts();

        $controllers->commentRepository();
        $comments = $controllers->commentRepository()->getComments();

        require('templates/dashboard.php');
    }
}
