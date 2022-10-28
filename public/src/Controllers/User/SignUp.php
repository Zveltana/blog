<?php
namespace Application\Controllers\User;

use Application\Common\Container;
use Application\Model\User;

class SignUp
{
    public function execute(): void
    {
        $session = $_SESSION;
        $server = $_SERVER;

        $container = new Container();
        $container->userRepository();

        $errors = [];

        if(isset($session['loggedUser'])){
            $container->redirection()->execute('index.php');
        }

        if ($server['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;

            $fields = [
                'fullName',
                'email',
                'password',
            ];

            foreach ($fields as $field)
            {
                if (empty($postData[$field])) {
                    $errors[$field] = 'Veuillez remplir ce champ.';
                }
            }

            if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['incorrect-email'] = 'Email incorrect.';
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
                $user = $container->userRepository()->getUserByEmail($postData['email']);


                $_SESSION['LOGGED_USER'] = strip_tags($postData['fullName']);
                $_SESSION['LOGGED_USER_ID'] = $user->getIdentifier();
                $_SESSION['LOGGED_USER_IS_ADMIN'] = false;

                $container->redirection()->execute('index.php');
            }
        }

        require_once ('templates/signup.php');
    }
}
