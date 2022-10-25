<?php
namespace Application\Controllers\Post;

use Application\Controllers\Controllers;

class Posts
{
    public function execute()
    {
        $controllers = new Controllers();

        $controllers->categoriesRepository();
        $categories = $controllers->categoriesRepository()->getCategories();

        $controllers->postRepository();
        $posts = $controllers->postRepository()->getPosts();

        require('templates/posts.php');
    }
}