<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\Redirect;
use Application\Model\Repository\CategoryRepository;
use Application\Model\Repository\CommentRepository;
use Application\Model\Repository\PostRepository;
use Application\Model\Repository\UsersRepository;

class Controllers
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

    public function getPosts(): array
    {
        return (new PostRepository($this->connection()))->getPosts();
    }

    public function verify_picture(): array|string
    {
        $picture = $_FILES['picture'];
        $message = [];

        $fileInfo = pathinfo($picture['name']);
        $extension = $fileInfo['extension'];

        $move = sprintf("img/blog/%s.%s", md5(basename($picture['name'])), $extension);

        if (isset($picture) && $picture['error'] === 0 && $picture['size'] <= 1000000) {
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg'];
            if (in_array($extension, $allowedExtensions, true)) {
                move_uploaded_file($_FILES['picture']['tmp_name'], $move);
            } else {
                return $message;
            }
        }

        return $move;
    }

    public function createPost(): bool
    {
        $title = strip_tags($_POST['title']);
        $author = $_SESSION['LOGGED_USER_ID'];
        $description = strip_tags($_POST['description']);
        $content = strip_tags($_POST['content']);
        $category = $_GET['id'];
        return (new PostRepository($this->connection()))->createPost($title, $author, $description, $content, $this->verify_picture(), $category);
    }
}