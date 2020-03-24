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
use App\Form\ContactFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        
        // use for pagination
        $activitys = $repo->findBySlug(array("Acrogivry-:-l'Aventure-en-Forêt-3", "Air-Escargot-14", "Acro'Bath,-Parc-de-Loisirs-Nature-2", "Diverti'parc-89", "Bourgogne-Montgolfière-37", "Altimage-ULM-15", "Ludothéque-29027"), array('Description' => 'asc'), null, null);
        
        $nbActiviys = $repo->nbActivitysTotos();
        $re = $repo->geolocVille();
        
//dump($activitys);die("stopppp");
        return $this->render('holidaysnew/index.html.twig', ['activitys' => $activitys, 'nbActivitys' => $nbActiviys]);
    }
    
    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {
        return $this->render('/mentions-legals.html.twig');
    }

    /**
     * @Route("/presentation-loisirsetsports", name="a-propos")
     */
    public function presentation()
    {
        return $this->render('/a-propos.html.twig');
    }
    
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request)
    {
        $user = new Contact();
        $form = $this->createForm(ContactFormType::class, $user);
        $form->handleRequest($request);

//        dd($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
//            dump( $form);die("sttooppp");
            // encode the plain password
            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email
            $this->addFlash('success', 'Merci de nous avoir contactés, nous vous répondrons dans les plus brefs délais');
        }
        return $this->render('holidaysnew/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    
}

