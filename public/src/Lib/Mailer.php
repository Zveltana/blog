<?php

namespace Application\Lib;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer as SymfonyMailer;

class Mailer
{
    private MailerInterface $mailer;

    public function __construct()
    {
        $transport = new EsmtpTransport('localhost', 1025);
        $this->mailer = new SymfonyMailer($transport);
    }

    public function send(
        Address $from,
        string $subject,
        string $text,
    ): void {
        $postData = $_POST;

        $email = (new Email())
            ->from($from)
            ->to('ameliamassot@gmail.com')
            ->subject($subject)
            ->text($text)
            ->html('<h1>Nouveau mail de : <span style="color:#7d695c;">' . htmlspecialchars($postData['firstName']) .' '. htmlspecialchars($postData['lastName']) . '</span></h1><br><h2>Sujet : ' . htmlspecialchars($postData['subject']) . '</h2><br><p>' . nl2br(htmlspecialchars($postData['content'])) .'</p>');

        $this->mailer->send($email);
    }
}