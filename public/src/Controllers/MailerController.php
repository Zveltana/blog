<?php

namespace Application\Controllers;

use Application\Lib\Mailer;
use Symfony\Component\Mime\Address;

class MailerController
{
    public function execute(): void
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {

                $postData = $_POST;

                $errors = [];

                if (empty($postData['firstName'])) {
                    $errors['firstName'] = 'Veuillez remplir ce champ.';
                }

                if (empty($postData['lastName'])) {
                    $errors['lastName'] = 'Veuillez remplir ce champ.';
                }

                if (empty($postData['email'])) {
                    $errors['email'] = 'Veuillez remplir ce champ.';
                }

                if (empty($postData['subject'])) {
                    $errors['subject'] = 'Veuillez remplir ce champ.';
                }

                if (empty($postData['content'])) {
                    $errors['content'] = 'Veuillez remplir ce champ.';
                }

                if (count($errors) === 0) {
                    (new Mailer())->send(
                        new Address(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['firstName'])),
                        htmlspecialchars($_POST['subject']),
                        nl2br(htmlspecialchars($_POST['content'])),
                    );

                    $controllers = new Controllers();
                    $controllers->redirection()->execute('index.php?action=submitContact');
                }
            }
        }

        require('templates/contact.php');
    }
}