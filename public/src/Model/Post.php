<?php

namespace Application\Model\Post;

require_once ('src/Lib/DatabaseConnection.php');

use Application\lib\Database\DatabaseConnection;
use Application\Model\Repository\Post\PostRepository;

class Post {
    public string $title;
    public string $content;
    public string $frenchCreationDate;
    public string $identifier;
}
