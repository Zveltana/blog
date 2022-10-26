<?php

namespace Application\Controllers\User;

use Application\Common\Container;

class Login
{
    public function execute(): void
    {
        $container = new Container();
        $container->userRepository();

        $errors = [];

        if(isset($_SESSION['LOGGED_USER'])){
            $container->redirection()->execute('index.php');
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
                $user = $container->userRepository()->getUserByEmail($postData['email']);

                $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier !');

                if ($user !== null && password_verify($postData['password'], $user->getPassword()) === true) {
                    $_SESSION['LOGGED_USER'] = $user->getFullName();
                    $_SESSION['LOGGED_USER_ID'] = $user->getIdentifier();
                    $_SESSION['LOGGED_USER_IS_ADMIN'] = $user->getIsAdmin();


                    $container->redirection()->execute('index.php');
                }
            }
        }

        require('templates/login.php');
    }
}