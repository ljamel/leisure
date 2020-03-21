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
    public function addActivity(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(\App\Entity\Activitys::class);
        $repoUser = $this->getDoctrine()->getRepository(\App\Entity\User::class);
        
        // use for pagination
        $activitys = $repo->findBy(array(), array('id' => 'desc'), null, null);
        
        $nbUsers = $repoUser->nbUsers();
        $nbActiviys = $repo->nbActivitysToto();
        
        return $this->render('holidaysnew/admin/index.html.twig', ['activitys' => $activitys, 'nbActivitys' => $nbActiviys, 'nbUsers' => $nbUsers]);
    }
    
    
}

