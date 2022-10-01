<?php

namespace Application\Model;

class Comment
{
    public string $identifier;
    public string $title;
    public User $author;
    public string $frenchCreationDate;
    public string $comment;
    public Post $postId;
    public bool $IsEnabled;
}