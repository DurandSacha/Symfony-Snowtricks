<?php
// src/Controller/dashboardController.php
/**
 * Created by PhpStorm.
 * User: sacha
 * Date: 12/06/2019
 * Time: 00:23
 */

namespace App\Controller;

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


class dashboardController  extends AbstractController
{

    public function dashboard(AuthenticationUtils $authenticationUtils){

        $visitorName = $authenticationUtils->getLastUsername();

        //$id = $this->getUser()->getId();

        return $this->render('Member/myprofile.html.twig',[
            'visitorName' => $visitorName

        ]);
    }
}