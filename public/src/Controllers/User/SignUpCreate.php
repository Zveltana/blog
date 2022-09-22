<?php
namespace Application\Controllers\User\SignUp;

require_once ('src/Model/Repository/UsersRepository.php');
require_once ('src/Lib/DatabaseConnection.php');

use Application\lib\Database\DatabaseConnection;
use Application\Model\Repository\Users\UsersRepository;

class SignUpCreate
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

            if (empty($postData['fullName'])) {
                $errors['fullName'] = 'Veuillez remplir ce champ.';
            }

            if (empty($postData['email'])) {
                $errors['email'] = 'Veuillez remplir ce champ.';
            }

            if (empty($postData['password'])) {
                $errors['password'] = 'Veuillez remplir ce champ.';
            }

            $user = $usersRepository->getUserByEmail($postData['email']);

            if ($user !== null){
                $errorMessage = sprintf('L\'email inscrit existe déjà.');
            }

            if (count($errors) === 0 && $user === null) {
                $createUser = $usersRepository->createUser($postData['fullName'], $postData['email'], $postData['password']);

                $_SESSION['LOGGED_USER'] = $postData['fullName'];

                header('Location: index.php');
            }
        }

        require_once ('templates/signup.php');
    }
}
