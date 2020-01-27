<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     *
     * Mon commentaire.
     */
    public function hello()
    {
        $name = 'Matthieu';

        dump($name);

        return $this->render('welcome/hello.html.twig', [
            'name' => $name,
        ]);
    }
}
