<?php

namespace Application\Controllers\User;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\UsersRepository;
use Application\Lib\Redirect;
use Application\Model\User;

class Login
{
    public function execute(): void
    {
        if(isset($_SESSION['LOGGED_USER'])){
            header('Location: index.php');
        }

        $connection = new DatabaseConnection();
        $usersRepository = new UsersRepository($connection);

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;

            if (empty($postData['email'])) {
                $errors['email'] = 'Veuillez remplir ce champ.';
            }

            if (empty($postData['password'])) {
                $errors['password'] = 'Veuillez remplir ce champ.';
            }

            if (count($errors) === 0) {
                $user = $usersRepository->getUserByEmail($postData['email']);

                $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier !');

                if ($user !== null && password_verify($postData['password'], $user->getPassword()) === true) {
                    $_SESSION['LOGGED_USER'] = $user->getFullName();
                    $_SESSION['LOGGED_USER_ID'] = $user->getIdentifier();
                    $_SESSION['LOGGED_USER_IS_ADMIN'] = $user->getIsAdmin();


                    header('Location: index.php');
                }
            }
        }

        require('templates/login.php');
    }
}