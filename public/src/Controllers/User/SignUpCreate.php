<?php
namespace Application\Controllers\User\SignUp;

require_once('src/Model/User.php');
require_once ('src/Lib/DatabaseConnection.php');

use Application\Model\Comment\CommentRepository;
use Application\lib\Database\DatabaseConnection;
use Application\Model\Login\UsersRepository;

class SignUpCreate
{
    public function execute(array $input)
    {
        $full_name = null;
        $email = null;
        $password = null;

        if (!empty($input['full_name']) && !empty($input['email']) && !empty($input['password'])) {
            $full_name = $input['full_name'];
            $email = $input['email'];
            $password = $input['password'];
        } else {
            throw new \Exception('Les données du formulaire sont invalide');
        }

        $usersRepository = new UsersRepository();
        $usersRepository->connection = new DatabaseConnection();
        $success = $usersRepository->createUser($full_name, $email, $password);

        if (!$success) {
            throw new \Exception('Impossible d\'ajouter l\'utilisateur');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }
}
