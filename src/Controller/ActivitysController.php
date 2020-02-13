<?php

namespace App\Controller;
/* 
 * Djamal LAMRI 16/08/1984.
 */
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ActivitysController extends AbstractController
{
    
    /**
     * @Route("/activites/{page}", name="activites")
     */
    public function allActivitys(int $page=0)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        
        // use for pagination
        if($page > 1)$page +=11;
        $activitys = $repo->findBy(array(), array('id' => 'desc'), 12, $page);
        
        $paginations = $repo->findAll();
        $nbbypage = count($paginations) / 24;
//dump($activitys);die("stopppp");
        return $this->render('holidaysnew/activitys.html.twig',[ 
                'activitys' => $activitys, 'pagination' => $nbbypage]);
    }
    
    /**
     * @Route("/activite-trouver", name="chearch")
     */
    public function result(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        
        $activitys = $repo->findByResult($request->request->get('city'), (int)$request->request->get('price'));
        
        // dump($activitys);die("stopppp");
        return $this->render('holidaysnew/result.html.twig',[ 
                'activitys' => $activitys]); 
    }
}
