<?php
// src/Controller/FrontController.php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Repository\CommentRepository;
use App\Repository\TricksRepository;
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

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Environment $twig, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em,PaginatorInterface $paginator, Request $request)
    {

        $tricksRepo = $em->getRepository(Tricks::class);
        $mediaRepo = $em->getRepository(Media::class);

        $user = $this->getUser();

        if (null === $user) {
            $visitorName = 'Anonyme';
        } else {
            $visitorName = $user->getUsername();
        }

        $tricks = $tricksRepo->findBy([], ['id' => 'DESC'], 9, 0);

        $content = $twig->render('front/home.html.twig',[
            'visitorName' => $visitorName,
            'tricks' => $tricks


        ]);
        return new Response($content);
    }

    /**
     * @Route("/single/{id}", name="single-tricks")
     */
    public function tricks($id, Environment $twig, EntityManagerInterface $em, Request $request,CommentRepository $commentRepo)
    {
        $tricksRepo = $em->getRepository(Tricks::class);
        $mediaRepo = $em->getRepository(Media::class);

        $trick = $tricksRepo->findOneBy(['id' => $id]);

        $medias = $trick->getIllustration();

        // default picture
        if(empty($medias)){
            $medias = 'demo/0.jpg';
        }
        //$comments = $trick->getComments();

        $comments = $commentRepo->findBy(['Tricks' => $trick->getId()], ['id' => 'DESC'], 3, 0);

        $embed = $mediaRepo->findBy(['type' => 'Embed']);


        $form = $this->createForm(AddCommentType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $commentForm = $form->getData();
            $comment = new Comment();
            $comment->setContent($form->get('content')->getData());
            $comment->setUser($this->getUser());
            /* setCreatedAt(new \DateTime() */
            $comment->setCreatedAt(new \DateTime());
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

    /**
     * @Route("/learn", name="learn")
     */
    public function learn(Environment $twig)
    {
        $content = $twig->render('front/learn.html.twig', [

        ]);
        return new Response($content);
    }

    /**
     * Get the 9 next tricks
     * @Route("/page/{start<\d+>?9}", name="loadMoreTricks")
     */
    public function loadMoreTricks($start = 9, TricksRepository $repository )
    {

        $tricks = $repository->findBy([], ['id' => 'DESC'], 9, $start);

        $user = $this->getUser();

        if (null === $user) {
            $visitorName = 'Anonyme';
        } else {
            $visitorName = $user->getUsername();
        }

        return $this->render('front/loadTricks.html.twig', [
            'tricks' => $tricks,
            'visitorName' => $visitorName,
        ]);
    }


    /**
     * Get the 5 next comments in the database and create a Twig file with them that will be displayed via Javascript
     *
     * @Route("/single/{id}/page/{start}", name="loadMoreComments", requirements={"start": "\d+"})
     */
    public function loadMoreComments(CommentRepository $commentRepository, TricksRepository $tricksRepository,  $id, $start = 3)
    {
        $trick = $tricksRepository->findOneById($id);
        $comments = $commentRepository->findBy(['Tricks' => $trick->getId()], ['id' => 'DESC'], 3, $start);
        return $this->render('front/loadComment.html.twig', [
            'trick' => $trick,
            'start' => $start,
            'comments' => $comments,
        ]);
    }




}

