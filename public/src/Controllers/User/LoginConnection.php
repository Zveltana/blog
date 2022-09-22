<?php

namespace Application\Controllers\User\Login;

require_once ('src/Lib/DatabaseConnection.php');
require_once ('src/Model/Repository/UsersRepository.php');
require_once ('src/Lib/Redirect.php');

use Application\lib\Database\DatabaseConnection;
use Application\Model\Repository\Users\UsersRepository;
use Application\Lib\Redirection\Redirect;
use Application\Model\UserLogin\User;

class LoginConnection
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

                    header('Location: index.php');
                } else {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier !');
                }
            }
        }

        require('templates/login.php');
    }
}