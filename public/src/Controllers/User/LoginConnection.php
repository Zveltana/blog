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
        var_dump($_SESSION);
        if(isset($_SESSION['loggedUser'])){
            die('va mourri');
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

                if ($user !== null && $user->getPassword() === $postData['password']) {
                    $_SESSION['LOGGED_USER'] = $user->getFullName();

                    header('Location: index.php');
                } else {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                        $postData['email'],
                        $postData['password']
                    );
                }
            }
        }

        require('templates/login.php');
    }
}