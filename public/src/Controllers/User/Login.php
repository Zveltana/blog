<?php

namespace Application\Controllers\User;

use Application\Common\Container;

class Login
{
    public function execute(): void
    {
        $session = $_SESSION;

        $container = new Container();
        $container->userRepository();

        $errors = [];

        if(isset($session['LOGGED_USER'])){
            $container->redirection()->execute('index.php');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;

            $fields = [
                'email',
                'password',
            ];

            foreach ($fields as $field)
            {
                if (empty($postdata[$field])) {
                    $errors[$field] = 'Veuillez remplir ce champ.';
                }
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