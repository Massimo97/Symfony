<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('blog.sf.b2@gmail.com')
            ->to('csiaud83@gmail.com')
            ->subject('Thanks for signing up!')
        
            // path of the Twig template to render
            ->htmlTemplate('emails/confirm_registration.html.twig')
        
            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'Creanics',
            ]);

        $mailer->send($email);
    }
}