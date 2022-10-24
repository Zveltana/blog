<?php
namespace Application\Controllers\User;

use Application\Lib\DatabaseConnection;
use Application\Lib\Redirect;
use Application\Model\Repository\UsersRepository;
use Application\Model\User;

class SignUp
{
    public function execute(): void
    {
        if(isset($_SESSION['loggedUser'])){
            $redirection = new Redirect();
            $redirection->execute('index.php');
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

            if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['incorrect-email'] = 'Email incorrect.';
            }

            if (empty($postData['password'])) {
                $errors['password'] = 'Veuillez remplir ce champ.';
            }

            $user = $usersRepository->getUserByEmail($postData['email']);

            if ($user !== null){
                $errorMessage = sprintf('L\'email inscrit existe déjà.');
            }

            if (count($errors) === 0 && $user === null) {
                $redirection = new Redirect();
                $user = new User();
                $user->setFullName(strip_tags($postData['fullName']));
                $user->setEmail($postData['email']);
                $user->setPassword($postData['password']);
                $createUser = $usersRepository->createUser($user);

                $_SESSION['LOGGED_USER'] = strip_tags($postData['fullName']);
                $_SESSION['LOGGED_USER_IS_ADMIN'] = false;

                $redirection->execute('index.php');
            }
        }

        require_once ('templates/signup.php');
    }
}
