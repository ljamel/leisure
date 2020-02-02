<?php
// src/Controller/IndexController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\ActivityFormType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN') ")
     */
    public function addActivity(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        
        $activitys = new \App\Entity\Activitys();
        $form = $this->createForm(ActivityFormType::class, $activitys);
        $form->handleRequest($request);
//        dump($this->getUser());die("stoooppp");
        if ($form->isSubmitted() && $form->isValid()) {
//            dump( $form);die("sttooppp");
            // encode the plain password

            $activitys->setIduser($this->getUser());
            $activitys->setPublish(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activitys);
            $entityManager->flush();


        }

//dump($activitys);die("stopppp");
        return $this->render('holidaysnew/admin/index.html.twig', [
            'activityForm' => $form->createView(),
        ]);
    }
    
    
}

