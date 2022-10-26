<?php session_start();

require ('vendor/autoload.php');

use Application\Common\Container;
use Application\Controllers\Homepage;
use Application\Controllers\Post\Post;
use Application\Controllers\Post\Posts;
use Application\Controllers\Post\AddPost;
use Application\Controllers\Post\UpdatePost;
use Application\Controllers\Post\DeletePost;
use Application\Controllers\Dashboard;
use Application\Controllers\SubmitContact;
use Application\Controllers\User\SignUp;
use Application\Controllers\User\Login;
use Application\Controllers\User\UpdateUser;
use Application\Controllers\User\DeleteUser;
use Application\Controllers\Comment\CheckComment;
use Application\Controllers\Comment\DeleteComment;
use Application\Controllers\User\Logout;
use Application\Controllers\MailerController;

try {
    $container = new Container;
    $container->postRepository();

    $array = [
        'updateUser' => UpdateUser::class,
        'deleteUser' => DeleteUser::class,
        'checkComment' => CheckComment::class,
        'deleteComment' => DeleteComment::class,
        'posts' => Posts::class,
        'contact' => MailerController::class,
        'submitContact' => SubmitContact::class,
        'login' => Login::class,
        'signup' => SignUp::class,
    ];

    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if (array_key_exists($_GET['action'], $array)) {
            (new $array[$_GET['action']])->execute();
        } elseif ($_GET['action'] === 'post') {
            if (isset($_POST['identifier']) && $_POST['identifier'] > 0) {
                $identifier = $_POST['identifier'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'dashboard' && isset($_SESSION['LOGGED_USER_IS_ADMIN']) && $_SESSION['LOGGED_USER_IS_ADMIN'] === true) {
            (new Dashboard())->execute();
        } elseif ($_GET['action'] === 'addPost' && isset($_SESSION['LOGGED_USER'])) {
            (new AddPost())->execute();
        } elseif ($_GET['action'] === 'updatePost' && isset($_SESSION['LOGGED_USER'])) {
            $post = $container->postRepository()->getPost($_POST['identifier']);

            if($_SESSION['LOGGED_USER_ID'] === $post->author) {
                (new UpdatePost())->execute();
            }
        } elseif ($_GET['action'] === 'deletePost' && isset($_SESSION['LOGGED_USER'])) {
            $post = $container->postRepository()->getPost($_POST['identifier']);

            if($_SESSION['LOGGED_USER_ID'] === $post->author){
                (new DeletePost())->execute();
            } else {
                throw new Exception('Vous n\'avez pas les droits pour accéder à cette page.');
            }
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
