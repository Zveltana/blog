<?php
namespace Application\Controllers\Post;

use Application\Common\Container;

class Posts
{
    public function execute()
    {
        $container = new Container();

        $container->categoriesRepository();
        $categories = $container->categoriesRepository()->getCategories();

        $container->postRepository();
        $posts = $container->postRepository()->getPosts();

        require('templates/posts.php');
    }
}