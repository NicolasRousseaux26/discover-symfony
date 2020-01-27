<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route(
     *    "/hello/{name}",
     *    name="hello",
     *    requirements={"name"="[a-z]{3,8}"}
     * )
     *
     * Mon commentaire.
     */
    public function hello($name = 'Matthieu')
    {
        // $name = 'Matthieu';

        dump($name);

        return $this->render('welcome/hello.html.twig', [
            'name' => ucfirst($name),
        ]);
    }
}
