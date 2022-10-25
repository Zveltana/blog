<?php

namespace Application\Controllers;

class Category {
    function execute()
    {
        $controllers = new Controllers();

        $controllers->categoriesRepository();
        $categories = $controllers->categoriesRepository()->getCategories();

        $controllers->postRepository();
        $post = $controllers->postRepository()->getPosts();

        require('templates/homepage.php');
    }
}
