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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\ActivityFormType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ActivitysController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    
    /**
     * @Route("/activites/{page}", name="activites")
     */
    public function allActivitys(int $page=0)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        
        // use for pagination
        if($page > 1)$page *=11+1;
        $city = $this->session->get('city');
        
        $activitys = $repo->findByPage(array(), array('id' => 'desc'), 20, $page, $city);
        
        $paginations = $repo->nbActivitys($this->session->get('city'));

        // after many testing just this solution
        $nbbypage = $paginations[0][1] / 12;
//dump($activitys);die("stopppp");
        return $this->render('holidaysnew/activitys.html.twig',[ 
                'activitys' => $activitys, 'pagination' => $nbbypage]);
    }
    
    /**
     * @Route("/activite-trouver/{city}", name="chearch", defaults={"city": 1})
     */
    public function result(Request $request)
    {
        // stores an attribute in the session for later reuse
        $this->session->set('city', $request->request->get('city'));

        // gets an attribute by name
       // $this->session->get('city');
        
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        
        $activitys = $repo->findByResult($request->request->get('city'), (int)$request->request->get('price'), $request->request->get('type'));
        
        // dump($activitys);die("stopppp");
        return $this->render('holidaysnew/result.html.twig',[ 
                'activitys' => $activitys]); 
    }
    
    /**
     * @Route("/activite-par-ville/{city}", name="postcode", defaults={"city": 1})
     */
    public function postcode(Request $request){
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
//        dd($request->attributes->get('city'));
        $activitys = $repo->findByPostCode($request->attributes->get('city'));
        
        // dump($activitys);die("stopppp");
        return $this->render('holidaysnew/result.html.twig',[ 
                'activitys' => $activitys]); 
    }
    
    
    /**
     * @Route("/show_activiter/{title}", name="show")
     */
    public function show($title){
        
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        $result = $repo->findOneBy(['slug' =>$title]);
        
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
        $result = $repo->findByCat($title, $this->session->get('city'));
        
        return $this->render('holidaysnew/cat.html.twig',[
                'activitys' => $result, 'title' => $title]);
    }
    
    
    /**
     * @Route("/addactivity", name="addactivity")
     * @Security("is_granted('ROLE_USER') ")
     */
    public function addActivity(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);

        $activitys = new \App\Entity\Activitys();
        $cats = $this->getDoctrine()->getRepository(\App\Entity\Categorys::class);
        $form = $this->createForm(ActivityFormType::class, $activitys);
//        dump($cats->findAll());die("stooopp");
        
        $categorys = array();
        foreach ($cats->findAll() as $key => $cat){
            array_push($categorys, $cat->getName());
        }
            
        
        $form->handleRequest($request);
//        dump($this->getUser());die("stoooppp");
        if ($form->isSubmitted() && $form->isValid()) {
//            dump( $form);die("sttooppp");
            // encode the plain password
            
//            dump($request->request->get('category'));die("stooopp");
            
            $cat = $cats->find($request->request->get('category'));
//            dump($cat);die("stooop");
            $activitys->addCategory($cat);
            
            $activitys->setIduser($this->getUser());
            $activitys->setPublish(0);
            $slug = $activitys->gettitle()."-".rand(333,1500000);
            $newslug = str_replace(" ", "-", $slug);
            $newslug = str_replace("/", "-", $newslug);

            $activitys->setSlug($newslug);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activitys);
            $entityManager->flush();
            $this->addFlash('success', 'Merci pour votre contribution');
            
            return $this->redirectToRoute('home');            
        }

//dump($activitys);die("stopppp");
        return $this->render('holidaysnew/addactivitie.html.twig', [
            'activityForm' => $form->createView(),
            'categorys' => $categorys,
        ]);
    }

}
