<?php
// src/Controller/IndexController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;

class IndexController extends AbstractController
{
    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('index.html.twig', [
            'number' => $number,
        ]);
    }    
}

