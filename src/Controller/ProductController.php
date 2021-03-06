<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class ProductController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/nos-produits", name="products")
     */
    public function index()
    {

        $products = $this->entityManager->getRepository(Product::class)->findAll();


        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }


  /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show($slug)
    {

        
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

        if (!$product) {
            return $this->redirectToRoute('products');
        } 

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }

}
