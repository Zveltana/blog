<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\PostRepository;
use Application\Lib\Redirect;
use Exception;

class UpdatePost
{
    function execute() {
        $postData = $_POST;
        $connection = new DatabaseConnection();
        $postRepository = new PostRepository($connection);
        $post = $postRepository->getPost($postData['identifier']);

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']){
                $post = $postRepository->getPostById($postData['identifier']);
                $redirection = new Redirect();

                if($postData['title'] !== $post->title || $postData['description'] !== $post->description || $postData['content'] !== $post->content || !empty($_FILES))
                {
                    $post->title = $postData['title'];
                    $post->description = $postData['description'];
                    $post->content = $postData['content'];

                    if (!empty($_FILES['picture']) && $_FILES['picture']['error'] === 0)
                    {
                        $fileInfo = pathinfo($_FILES['picture']['name']);
                        $extension = $fileInfo['extension'];

                        $move = sprintf("img/blog/%s.%s", md5(basename($_FILES['picture']['name'])), $extension);

                        if ($_FILES['picture']['size'] <= 1000000)
                        {
                            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg'];
                            if (in_array($extension, $allowedExtensions, true))
                            {
                                move_uploaded_file($_FILES['picture']['tmp_name'], $move);

                                if (file_exists($post->picture)) {
                                    unlink($post->picture);
                                }
                                $post->picture = $move;
                            }
                        }
                    }

                    $postRepository->updatePost($post);
                    $redirection->execute('index.php?action=posts');
                }

                $errorMessage = sprintf('Aucune modification effectuée !');
            } else {
                throw new Exception('Jeton de sécurité périmé');
            }

        }
        require('templates/updatePost.php');
    }
}