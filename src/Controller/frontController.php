<?php
// src/Controller/FrontController.php

namespace App\Controller;

use App\Entity\Comment;
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
use App\Form\AddCommentType;
use Knp\Component\Pager\PaginatorInterface;

class frontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Environment $twig, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em,PaginatorInterface $paginator, Request $request)
    {



        $tricksRepo = $em->getRepository(Tricks::class);
        $mediaRepo = $em->getRepository(Media::class);

        $user = $this->getUser();

        // Tester l'objet User pour voir s'il est vide
        if (null === $user) {
            $visitorName = 'Anonyme';
        } else {
            $visitorName = $user->getUsername();
        }

        /**** PAGINATION **/
        $q = $request->query->get('q');
        $queryBuilder = $tricksRepo->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        $content = $twig->render('front/home.html.twig',[
            'visitorName' => $visitorName,
            'pagination' => $pagination


        ]);
        return new Response($content);
    }

    /**
     * @Route("/single/{id}", name="single-tricks")
     */
    public function tricks($id, Environment $twig, EntityManagerInterface $em, Request $request)
    {
        $tricksRepo = $em->getRepository(Tricks::class);
        $mediaRepo = $em->getRepository(Media::class);

        $trick = $tricksRepo->findOneBy(['id' => $id]);
        $medias = $trick->getIllustration();
        $comments = $trick->getComments();
        $embed = $mediaRepo->findBy(['type' => 'Embed']);


        $form = $this->createForm(AddCommentType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $commentForm = $form->getData();
            $comment = new Comment();
            $comment->setContent($form->get('content')->getData());
            $comment->setUser($this->getUser());
            $comment->setTricks($trick);

            $em->persist($comment);
            $em->flush();
        }

        $content = $twig->render('front/single.html.twig',[
            'id'  => $id,
            'trick' => $trick,
            'medias' => $medias,
            'comments' => $comments,
            'Embed' => $embed,
            'AddCommentForm' => $form->createView(),
        ]);
        return new Response($content);
    }
}

