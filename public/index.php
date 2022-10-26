<?php session_start();

require ('vendor/autoload.php');

use Application\Controllers\Controllers;
use Application\Controllers\Homepage;
use Application\Controllers\Post\Post;
use Application\Controllers\Post\Posts;
use Application\Controllers\Post\AddPost;
use Application\Controllers\Post\UpdatePost;
use Application\Controllers\Post\DeletePost;
use Application\Controllers\Dashboard;
use Application\Controllers\submitContact;
use Application\Controllers\User\SignUp;
use Application\Controllers\User\Login;
use Application\Controllers\User\UpdateUser;
use Application\Controllers\User\DeleteUser;
use Application\Controllers\Comment\CheckComment;
use Application\Controllers\Comment\DeleteComment;
use Application\Lib\DatabaseConnection;
use Application\Controllers\User\Logout;
use Application\Controllers\MailerController;
use Application\Model\Repository\PostRepository;

try {
    $controllers = new Controllers;
    $controllers->postRepository();

    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_POST['identifier']) && $_POST['identifier'] > 0) {
                $identifier = $_POST['identifier'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'dashboard' && isset($_SESSION['LOGGED_USER_IS_ADMIN']) && $_SESSION['LOGGED_USER_IS_ADMIN'] === true) {
            (new Dashboard())->execute();
        } elseif ($_GET['action'] === 'updateUser') {
            (new UpdateUser())->execute();
        } elseif ($_GET['action'] === 'deleteUser') {
            (new DeleteUser())->execute();
        } elseif ($_GET['action'] === 'checkComment') {
            (new CheckComment())->execute();
        } elseif ($_GET['action'] === 'deleteComment') {
            (new DeleteComment())->execute();
        } elseif ($_GET['action'] === 'posts') {
            (new Posts())->execute();
        } elseif ($_GET['action'] === 'addPost' && isset($_SESSION['LOGGED_USER'])) {
            (new AddPost())->execute();
        } elseif ($_GET['action'] === 'updatePost' && isset($_SESSION['LOGGED_USER'])) {
            $post = $controllers->postRepository()->getPost($_POST['identifier']);

            if($_SESSION['LOGGED_USER_ID'] === $post->author) {
                (new UpdatePost())->execute();
            }
        } elseif ($_GET['action'] === 'deletePost' && isset($_SESSION['LOGGED_USER'])) {
            $post = $controllers->postRepository()->getPost($_POST['identifier']);

            if($_SESSION['LOGGED_USER_ID'] === $post->author){
                (new DeletePost())->execute();
            } else {
                throw new Exception('Vous n\'avez pas les droits pour accéder à cette page.');
            }
        } elseif ($_GET['action'] === 'contact') {
            (new MailerController())->execute();
        } elseif ($_GET['action'] === 'submitContact') {
            (new SubmitContact())->execute();
        } elseif ($_GET['action'] === 'login') {
            (new Login())->execute();
        } elseif ($_GET['action'] === 'signup') {
            (new SignUp())->execute();
        } elseif ($_GET['action'] === 'logout' && isset($_SESSION['LOGGED_USER'])) {
            (new Logout())->execute();
        } else {
            throw new Exception('La page que vous recherchez n\'existe pas !');
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require ('templates/error.php');
}

if(!isset($_SESSION['token'])) {
    $_SESSION['token'] = md5(time()*random_int(175, 658));
}
