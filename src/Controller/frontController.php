<?php
// src/Controller/frontController.php

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

class frontController extends AbstractController
{
    public function home(Environment $twig, AuthenticationUtils $authenticationUtils)
    {
        $doctrine = $this->getDoctrine()->getManager();

        $tricks = new tricks();

        $tricksRepo = $doctrine->getRepository(Tricks::class);
        $tricks = $tricksRepo->findAll(); /* getTricks() */

        $visitorName = $authenticationUtils->getLastUsername();

        $content = $twig->render('front/home.html.twig',[
            'visitorName' => $visitorName,
            'tricks' => $tricks,
        ]);
        return new Response($content);
    }

    public function tricks($id)
    {

        return $this->render(
            'front/single.html.twig',
            [
                'id'  => $id,
                'name' => 'sacha'
                ]);
    }
}


/*
        $tricks->setName('Ollie Tricks');
        $em->persist($tricks);
        $em->flush();
*/
