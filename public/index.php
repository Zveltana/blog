<?php session_start();

require_once('src/Controllers/Comment/AddComment.php');
require_once('src/Controllers/Comment/EditComment.php');
require_once('src/Controllers/Homepage.php');
require_once('src/Controllers/Post.php');
require_once('src/Controllers/User/LoginConnection.php');
require_once('src/Controllers/User/SignUpCreate.php');
require_once('src/Lib/Redirect.php');

use Application\Controllers\Comment\Add\AddComment;
use Application\Controllers\Comment\Update\EditComment;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Post\Post;
use Application\Controllers\User\SignUp\SignUpCreate;
use Application\Controllers\User\Login\LoginConnection;
use Application\Lib\Redirection\Redirect;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new AddComment())->execute($identifier, $_POST);
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
        } elseif ($_GET['action'] === 'login') {
            (new LoginConnection())->execute();
        } elseif ($_GET['action'] === 'signup') {
            (new SignUpCreate())->execute();
        } elseif ($_GET['action'] === 'logout') {
            (new Redirect())->execute( 'LogoutConnection.php');
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
