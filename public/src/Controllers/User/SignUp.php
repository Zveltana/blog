<?php
namespace Application\Controllers\User;

use Application\Lib\DatabaseConnection;
use Application\Model\Repository\UsersRepository;
use Application\Model\User;

class SignUp
{
    public function execute(): void
    {
        if(isset($_SESSION['loggedUser'])){
            header('Location: index.php');
        }

        $connection = new DatabaseConnection();

        $usersRepository = new UsersRepository($connection);

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
                $user = new User();
                $user->setFullName(strip_tags($postData['fullName']));
                $user->setEmail(strip_tags($postData['email']));
                $user->setPassword(strip_tags($postData['password']));
                $createUser = $usersRepository->createUser($user);

                $_SESSION['LOGGED_USER'] = strip_tags($postData['fullName']);
                $_SESSION['LOGGED_USER_IS_ADMIN'] = false;

                header('Location: index.php');
            }
        }

        require_once ('templates/signup.php');
    }
}
