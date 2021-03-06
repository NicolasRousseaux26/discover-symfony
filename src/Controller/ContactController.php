<?php

/*
 * This file is part of the discover package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Form\ContactType;
use App\Model\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_index")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($contact);
            $this->addFlash('success', 'Votre message a bien été envoyé.');

            // Envoi du mail
            $email = (new Email())
                ->from('contact@monsite.com')
                ->to('admin@monsite.com')
                ->subject($contact->getName().' a fait une demande')
                ->html('<h1>Email: '.$contact->getEmail().'</h1>');

            $mailer->send($email);

            // return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
