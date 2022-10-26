<?php
namespace Application\Controllers\User;

use Application\Common\Container;
use Application\Model\User;

class SignUp
{
    public function execute(): void
    {
        $container = new Container();
        $container->userRepository();

        $errors = [];

        if(isset($_SESSION['loggedUser'])){
            $container->redirection()->execute('index.php');
        }

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

            $user = $container->userRepository()->getUserByEmail($postData['email']);

            if ($user !== null){
                $errorMessage = sprintf('L\'email inscrit existe déjà.');
            }

            if (count($errors) === 0 && $user === null) {
                $user = new User();
                $user->setFullName(strip_tags($postData['fullName']));
                $user->setEmail($postData['email']);
                $user->setPassword($postData['password']);
                $createUser = $container->userRepository()->createUser($user);

                $_SESSION['LOGGED_USER'] = strip_tags($postData['fullName']);
                $_SESSION['LOGGED_USER_IS_ADMIN'] = false;

                $container->redirection()->execute('index.php');
            }
        }

        require_once ('templates/signup.php');
    }
}
