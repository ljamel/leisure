<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="create_product")
     */
    public function createProduct(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Products();
        $product->setName('play');
        $product->setPrice(859);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }
    
    /**
    * @Route("/product/{id}", name="product_show")
    */
        public function show($id)
    {
        $repo = $this->getDoctrine()
            ->getRepository(Products::class);
        
        $product = $repo->findOneBy([
            'name' => 'Keyboard',
            'price' => 1999,
        ]);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

//        return new Response('Check out this great product: '.$product->getName());

        // or render a template
//         in the template, print things with {{ product.name }}
         return $this->render('product/show.html.twig', ['product' => $product]);
    }
    
    /**
     * @Route("/template", name="template")
     */
    public function template()
    {
        return $this->render('holidays/index.html.twig');
    }
}

