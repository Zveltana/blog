<?php session_start();

require ('vendor/autoload.php');

use Application\Controllers\Comment\EditComment;
use Application\Controllers\Homepage;
use Application\Controllers\Post;
use Application\Controllers\Posts;
use Application\Controllers\Category;
use Application\Controllers\Dashboard;
use Application\Controllers\User\SignUp;
use Application\Controllers\User\Login;
use Application\Controllers\User\UpdateUser;
use Application\Controllers\Comment\CheckComment;
use Application\Lib\Redirect;
use Application\Controllers\User\Logout;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'category') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                (new Category())->execute();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'editComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                $input = null;

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new EditComment())->execute($identifier, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'dashboard') {
            (new Dashboard())->execute();
        } elseif ($_GET['action'] === 'updateUser') {
            (new UpdateUser())->execute();
        } elseif ($_GET['action'] === 'checkComment') {
            (new CheckComment())->execute();
        } elseif ($_GET['action'] === 'posts') {
            (new Posts())->execute();
        } elseif ($_GET['action'] === 'login') {
            (new Login())->execute();
        } elseif ($_GET['action'] === 'signup') {
            (new SignUp())->execute();
        } elseif ($_GET['action'] === 'logout') {
            (new Logout())->execute();
        } else {
            throw new Exception('La page que vous recherchez n\'existe pas');
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require ('templates/error.php');
}
