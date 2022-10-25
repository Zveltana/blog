<?php

namespace Application\Controllers\Comment;

use Application\Controllers\Controllers;

class CheckComment
{
    function execute() {
        $controllers = new Controllers();
        $controllers->userRepository();
        $controllers->postRepository();
        $post = $controllers->postRepository()->getPosts();
        $controllers->commentRepository();
        $comments = $controllers->commentRepository()->getComments();
        $controllers->redirection();


        $controllers->commentRepository()->checkComment($_GET['id']);

        $controllers->redirection()->execute('index.php?action=dashboard');
    }
}