<?php

namespace Application\Controllers;

use Application\Common\Container;
use Application\Lib\Mailer;
use Symfony\Component\Mime\Address;

class MailerController
{
    public function execute(): void
    {
        $session = $_SESSION;
        $server = $_SERVER;
        $postData = $_POST;

        if (('POST' === $server['REQUEST_METHOD']) && isset($postData['token']) && $postData['token'] === $session['token']) {

            $errors = [];

            $fields = [
                'firstName',
                'lastName',
                'email',
                'subject',
                'content',
            ];

            foreach ($fields as $field)
            {
                if (empty($postData[$field])) {
                    $errors[$field] = 'Veuillez remplir ce champ.';
                }
            }

            if (count($errors) === 0) {
                (new Mailer())->send(
                    new Address(htmlspecialchars($postData['email']), htmlspecialchars($postData['firstName'])),
                    htmlspecialchars($postData['subject']),
                    nl2br(htmlspecialchars($postData['content'])),
                );

                $container = new Container();
                $container->redirection()->execute('index.php?action=submitContact');
            }
        }

        require('templates/contact.php');
    }
}