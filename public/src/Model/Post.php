<?php

namespace Application\Model\PostView;

require_once ('src/Lib/DatabaseConnection.php');

class Post {
    public string $title;
    public string $content;
    public string $frenchCreationDate;
    public string $identifier;
}
