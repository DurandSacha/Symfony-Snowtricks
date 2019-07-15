<?php
// src/Controller/dashboardController.php
/**
 * Created by PhpStorm.
 * User: sacha
 * Date: 12/06/2019
 * Time: 00:23
 */

namespace App\Controller;

use App\Repository\TricksRepository;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Tricks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * @IsGranted("ROLE_USER")
 */
class dashboardController  extends BaseController
{

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(AuthenticationUtils $authenticationUtils, LoggerInterface $logger){

        $menu_active  = true;
        //$logger->debug('Checking account page for '.$this->getUser()->getEmail());
        $idUser = $this->getUser()->getId();

        return $this->render('Member/dashboard.html.twig',[
            'menu_active' => $menu_active,
        ]);
    }

    /**
     * @Route("/trickList", name="trickList")
     */
    public function list(TricksRepository $tricksRepo)
    {
        $menu_active  = true;
        //$tricksRepo = $em->getRepository(Tricks::class);
        $tricks = $tricksRepo->findAll();

        return $this->render('Member/listTricks.html.twig', [
            'tricks' => $tricks,
            'menu_active' => $menu_active,
        ]);
    }


    /**
     * @Route("/api/account", name="api_account")
     */
    public function accountApi()
    {
        $user = $this->getUser();
        return $this->json($user, 200, [], [
            'groups' => ['main'],
        ]);
    }
}
