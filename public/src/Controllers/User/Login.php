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
        if(isset($_SESSION['loggedUser'])){
            header('Location: index.php');
        }

        $connection = new DatabaseConnection();

        $usersRepository = new UsersRepository();
        $usersRepository->connection = new DatabaseConnection();

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

                if ($user !== null && password_verify($postData['password'], $user->getPassword()) === true) {
                    $_SESSION['LOGGED_USER'] = $user->getFullName();
                    $_SESSION['LOGGED_USER_id'] = $user->getIdentifier();


                    header('Location: index.php');
                } else {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier !');
                }
            }
        }

        require('templates/login.php');
    }
}