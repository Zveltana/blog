<?php

namespace Application\Model\Comment;

use Application\lib\Database\DatabaseConnection;
use Application\Model\Repository\Comment\CommentRepository;

require_once ('src/Lib/DatabaseConnection.php');

class Comment
{
    public string $identifier;
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
    public string $post;
}