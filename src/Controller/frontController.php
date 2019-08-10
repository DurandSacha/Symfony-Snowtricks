<?php
// src/Controller/frontController.php

namespace App\Controller;

use App\Entity\Media;
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
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class frontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Environment $twig, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em)
    {

        $tricksRepo = $em->getRepository(Tricks::class);
        $tricks = $tricksRepo->findAll(); /* getTricks() */

        $user = $this->getUser();

        // Tester l'objet User pour voir s'il est vide
        if (null === $user) {
            $visitorName = 'Anonyme';
        } else {
            $visitorName = $user->getUsername();
        }

        $content = $twig->render('front/home.html.twig',[
            'visitorName' => $visitorName,
            'tricks' => $tricks

        ]);
        return new Response($content);
    }

    /**
     * @Route("/single/{id}", name="single-tricks")
     */
    public function tricks($id, Environment $twig, EntityManagerInterface $em)
    {
        $tricksRepo = $em->getRepository(Tricks::class);
        $mediaRepo = $em->getRepository(Media::class);

        //$media = $mediaRepo->findBy(['tricks_id' => $id]);
        $trick = $tricksRepo->findOneBy(['id' => $id]);
        $medias = $trick->getIllustration();
        $comments = $trick->getComments();

        $content = $twig->render('front/single.html.twig',[
            'id'  => $id,
            'name' => 'sacha',
            'trick' => $trick,
            'medias' => $medias,
            'comments' => $comments
        ]);
        return new Response($content);
    }
}


/*
        $tricks->setName('Ollie Tricks');
        $em->persist($tricks);
        $em->flush();
*/
