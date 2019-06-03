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

use App\Entity\Tricks;
use Doctrine\ORM\EntityManagerInterface;

class frontController extends AbstractController
{

    public function home(Environment $twig)
    {
        $doctrine = $this->getDoctrine()->getManager();

        $tricks = new tricks();

        $tricksRepo = $doctrine->getRepository(Tricks::class);
        $tricks = $tricksRepo->findAll(); /* getTricks() */

        $content = $twig->render('front/home.html.twig',[
            'tricksName' => "tricks one ",
            'tricks' => $tricks
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
