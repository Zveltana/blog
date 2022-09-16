<?php

namespace Application\Controllers\User\Login;

use Application\lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;
use Application\Model\Login\UsersRepository;

require_once ('src/Lib/DatabaseConnection.php');
require_once ('src/Model/user.php');

class LoginConnection
{
    public function execute(array $input): void
    {
        if (isset($input['email']) && isset($input['password'])) {
            foreach ($users as $user) {
                if (
                    $user['email'] === $input['email'] &&
                    $user['password'] === $input['password']
                ) {
                    $loggedUser = [
                        'email' => $user['email'],
                        'full_name' => $user['full_name'],
                    ];
                } else {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                        $input['email'],
                        $input['password']
                    );
                }
            }
        }

        require('templates/login.php');
    }
}