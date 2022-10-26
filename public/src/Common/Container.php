<?php

namespace Application\Common;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\CategoryRepository;
use Application\Model\Repository\CommentRepository;
use Application\Model\Repository\PostRepository;
use Application\Model\Repository\UsersRepository;
use Application\Verifier\PictureVerifier;

class Container
{
    public function redirection(): Redirect
    {
        return new Redirect();
    }

    public function connection(): DatabaseConnection
    {
        return new DatabaseConnection();
    }

    public function postRepository(): PostRepository
    {
        return new PostRepository($this->connection());
    }

    public function userRepository(): UsersRepository
    {
        return new UsersRepository($this->connection());
    }

    public function commentRepository(): CommentRepository
    {
        return new CommentRepository($this->connection(), $this->userRepository(), $this->postRepository());
    }

    public function categoriesRepository(): CategoryRepository
    {
        return new CategoryRepository($this->connection());
    }

    public function pictureVerifier(): PictureVerifier
    {
        return new PictureVerifier();
    }
}