<?php

namespace Application\Controllers\User\Login;

use Application\lib\Database\DatabaseConnection;
use Application\Model\Repository\Comment\CommentRepository;
use Application\Model\Repository\Users\UsersRepository;
use Application\Lib\Renderer\Render;
use Application\Lib\Redirection\Redirect;
use Application\Model\UserLogin\User;

require_once ('src/Lib/DatabaseConnection.php');
require_once ('src/Lib/Redirect.php');
require_once ('src/Model/Repository/UsersRepository.php');
require_once ('src/Model/User.php');

class LoginConnection
{
    public DatabaseConnection $connection;

    public function execute(array $input): void
    {
        $usersRepository = new UsersRepository();
        $usersRepository->connection = new DatabaseConnection();

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (empty($input['email'])) {
                $errors['email'] = 'Veuillez remplir ce champ.';
            }

            if (empty($input['password'])) {
                $errors['password'] = 'Veuillez remplir ce champ.';
            }

            $postData = $input;

            if (isset($postData['email'], $postData['password'])) {
                $users = new User();

                foreach ($users as $user) {
                    if (
                        $user['email'] === $postData['email'] &&
                        $user['password'] === $postData['password']
                    ) {
                        $loggedUser = [
                            'email' => $user['email'],
                        ];

                        $_SESSION['LOGGED_USER'] = $loggedUser['email'];
                    } else {
                        $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                            $postData['email'],
                            $postData['password']
                        );
                    }
                }
            }

            if (isset($_SESSION['LOGGED_USER'])) {
                $loggedUser = [
                    'email' => $_SESSION['LOGGED_USER'],
                ];
            }

            if (count($errors) === 0) {
                $redirect = new Redirect();
                $redirect->execute('?page=home');
            }
        }

        require('templates/login.php');
    }
}