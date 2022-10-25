<?php

namespace Application\Controllers\User;

use Application\Controllers\Controllers;
use Application\Lib\Redirect;

class Login
{
    public function execute(): void
    {
        $controllers = new Controllers();
        $controllers->userRepository();

        $errors = [];

        if(isset($_SESSION['LOGGED_USER'])){
            $controllers->redirection()->execute('index.php');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;

            if (empty($postData['email'])) {
                $errors['email'] = 'Veuillez remplir ce champ.';
            }

            if (empty($postData['password'])) {
                $errors['password'] = 'Veuillez remplir ce champ.';
            }

            if (count($errors) === 0) {
                $user = $controllers->userRepository()->getUserByEmail($postData['email']);

                $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier !');

                if ($user !== null && password_verify($postData['password'], $user->getPassword()) === true) {
                    $redirection = new Redirect();
                    $_SESSION['LOGGED_USER'] = $user->getFullName();
                    $_SESSION['LOGGED_USER_ID'] = $user->getIdentifier();
                    $_SESSION['LOGGED_USER_IS_ADMIN'] = $user->getIsAdmin();


                    $controllers->redirection()->execute('index.php');
                }
            }
        }

        require('templates/login.php');
    }
}