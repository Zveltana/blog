<?php
namespace Application\Controllers;

use Application\Model\Repository\CategoryRepository;
use Application\Model\Repository\PostRepository;
use Application\Lib\DatabaseConnection;

class Homepage
{
    public function execute()
    {
        require('templates/homepage.php');
    }
}
