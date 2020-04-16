<?php
// src/Controller/IndexController.php
namespace App\Controller;
/* 
 * Djamal LAMRI 16/08/1984.
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\ActivityFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Categorys;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN') ")
     */
    public function home(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        $repoUser = $this->getDoctrine()->getRepository(\App\Entity\User::class);
        
        // use for pagination
        $activitys = $repo->findBy(array(), array('id' => 'desc'), null, null);
        
        $nbUsers = $repoUser->nbUsers();
        $nbActiviys = $repo->nbActivitysTotos();
        
        return $this->render('holidaysnew/admin/index.html.twig', ['activitys' => $activitys, 'nbActivitys' => $nbActiviys, 'nbUsers' => $nbUsers]);
    }
    
    /**
     * @Route("/admin/activitie/{slug}", name="activitie")
     * @Security("is_granted('ROLE_ADMIN') ")
     */
    public function activitieModifi(Request $request, $slug)
    {

        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);

        $activitys = new \App\Entity\Activitys();
        
        $activitie = $repo->findOneBy(['slug' => $slug]);
//        dd($activitie);
        
        $activitys->setTitle($activitie->getTitle());
        
        $cats = $this->getDoctrine()->getRepository(\App\Entity\Categorys::class);
        $image = $this->getDoctrine()->getRepository(\App\Entity\Images::class);
        
        $form = $this->createForm(ActivityFormType::class, $activitie);
//        dump($images->findAll());die("stooopp");
        
        $images = array();
        foreach ($image->findAll() as $key => $image){
            array_push($images, $image->getImg());
        }
        
        $categorys = array();
        foreach ($cats->findAll() as $key => $cat){
            array_push($categorys, $cat->getName());
        }
        
        $form->handleRequest($request);
//        dump($this->getUser());die("stoooppp");
        if ($form->isSubmitted() && $form->isValid()) {
            
            if($request->request->get('category')){
                $cat = $cats->find($request->request->get('category'));
            }else{
                $cat = $cats->find(1);
            }

            $activitie->addCategory($cat);
            
            $activitie->setIduser($this->getUser());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activitie);
            $entityManager->flush();
            $this->addFlash('success', 'Activitys editet');
                 
        }
        
        return $this->render('holidaysnew/admin/Activitie.html.twig', [
            'activityForm' => $form->createView(),
            'categorys' => $categorys,
            'images' => $images,
        ]);
    }
    
    /**
     * @Route("/admin/activitys", name="activitys")
     * @Security("is_granted('ROLE_ADMIN') ")
     */
    public function activitys(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        $repoUser = $this->getDoctrine()->getRepository(\App\Entity\User::class);
        
        // use for pagination
        $activitys = $repo->findBy(array(), array('id' => 'desc'), null, null);
        
        $nbUsers = $repoUser->nbUsers();
        $nbActiviys = $repo->nbActivitysTotos();
        
        return $this->render('holidaysnew/admin/Activitys.html.twig', ['activitys' => $activitys, 'nbActivitys' => $nbActiviys, 'nbUsers' => $nbUsers]);
 
    }
    
    
}

