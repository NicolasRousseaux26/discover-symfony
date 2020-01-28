<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $products = [];

    public function __construct()
    {
        // On initialise un tableau avec des produits
        // La propriété $products est accessible sur toutes les routes...
        $this->products = [
            ['name' => 'iPhone X', 'slug' => 'iphone-x', 'description' => 'Un iPhone de 2017', 'price' => 999],
            ['name' => 'iPhone XR', 'slug' => 'iphone-xr', 'description' => 'Un iPhone de 2018', 'price' => 1099],
            ['name' => 'iPhone XS', 'slug' => 'iphone-xs', 'description' => 'Un iPhone de 2018', 'price' => 1199]
        ];
    }

    /**
     * @Route("/product/random", name="product_random")
     */
    public function random()
    {
        // Récupérer la liste des produits ?
        dump($this->products);
        // Récupérer un produit aléatoire dans ce tableau
        $index = array_rand($this->products);
        $product = $this->products[$index];
        dump($product);

        return new Response('<body>'.$product['name'].'</body>');
    }

    /**
     * @Route("/product", name="product_list")
     */
    public function list()
    {
        return $this->render('product/list.html.twig', [
            'products' => $this->products,
        ]);
    }

    /**
     * @Route("/product/create", name="product_create")
     */
    public function create()
    {
        return $this->render('product/create.html.twig');
    }

    /**
     * @Route("/product/{slug}", name="product_show")
     */
    public function show($slug)
    {
        // Le slug passé dans l'url
        dump($slug);

        // On va parcourir tous les produits
        foreach ($this->products as $product) {
            // On va comparer le slug de chaque produit avec celui de l'url
            if ($slug === $product['slug']) {
                dump($product);
                // Si un produit existe, on retourne le template et on arrête le code
                return $this->render('product/show.html.twig', ['product' => $product]);
            }
        }

        // Après avoir parcouru le tableau, si aucun produit ne correspond, on affiche une 404
        throw $this->createNotFoundException('Le produit n\'existe pas.');
    }
}
