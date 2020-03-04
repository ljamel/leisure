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
        if($page > 1)$page *=11+1;
        $activitys = $repo->findByPage(array(), array('id' => 'desc'), 12, $page);
        
        $paginations = $repo->nbActivitys();
        $nbbypage = $paginations[0][1] / 14;
//dump($activitys);die("stopppp");
        return $this->render('holidaysnew/activitys.html.twig',[ 
                'activitys' => $activitys, 'pagination' => $nbbypage]);
    }
    
    /**
     * @Route("/activite-trouver/{city}", name="chearch", defaults={"city": 1})
     */
    public function result(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        dd($request->request->get('city'));
        $activitys = $repo->findByResult($request->request->get('city'), (int)$request->request->get('price'));
        
        // dump($activitys);die("stopppp");
        return $this->render('holidaysnew/result.html.twig',[ 
                'activitys' => $activitys]); 
    }
    
    /**
     * @Route("/show_activiter/{title}", name="show")
     */
    public function show($title){
        
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        $result = $repo->findOneBy(['Title' =>$title]);
        
        if(!$result){
            $result = $repo->findByCat($title);
        
            return $this->render('holidaysnew/cat.html.twig',[
            'activitys' => $result, 'title' => $title]);
        }
        
        return $this->render('holidaysnew/show.html.twig',[
                'activity' => $result]);
    }
    
    /**
     * @Route("/activiter/{title}", name="category")
     */
    public function category($title){
        
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        
        // utiliser like <<<------
        $result = $repo->findByCat($title);
        
        return $this->render('holidaysnew/cat.html.twig',[
                'activitys' => $result, 'title' => $title]);
    }
    

}
