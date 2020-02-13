<?php
// src/Controller/IndexController.php
namespace App\Controller;
/* 
 * Djamal LAMRI 16/08/1984.
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        
        // use for pagination
        $activitys = $repo->findBy(array(), array('id' => 'desc'), 3, null);
        
//dump($activitys);die("stopppp");
        return $this->render('holidaysnew/index.html.twig', ['activitys' => $activitys]);
    }
    
    
}

