<?php
// src/Controller/tricksController.php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Form\addTricksFormType;
use App\Service\Upload;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use App\Form\ArticleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\mediaController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;


/**
 * @property  mediaController
 * @IsGranted("ROLE_MEMBER")
 */
class tricksController extends AbstractController
{
    public const TRICK_REFERENCE = 'trick';

    /**
    * @Route("/addTricks", name="admin_tricks_new")
    */
    public function add(EntityManagerInterface $em, Request $request, Upload $upload)
    {
        $form = $this->createForm(addTricksFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $PictureFile = $form->get('picture')->getData();

            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            $media = $upload->addMedia($PictureFile,$trick);
            $trick->addIllustration($media);




            $this->addFlash('success', 'Tricks ' . $trick->getName() . ' is created');

            return $this->redirectToRoute('trickList');
        }

        return $this->render('Member/addTricks.html.twig', [
            'addTricksForm' => $form->createView(),
        ]);



        // directory en config :
    }

    /**
     * @Route("/admin/article/{tricks}/edit", name="admin_article_edit")
     */
    public function edit(Tricks $tricks, Request $request, EntityManagerInterface $em, Upload $upload)
    {


        $form = $this->createForm(addTricksFormType::class, $tricks);
        $form->handleRequest($request);
        $tricks->setAuthor($this->getUser());
        if ($form->isSubmitted() && $form->isValid()) {

            $PictureFile = $form->get('picture')->getData();

            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            $media = $upload->addMedia($PictureFile,$trick);
            $trick->addIllustration($media);


            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');
            return $this->redirectToRoute('admin_article_edit', [
                'tricks' => $tricks->getId(),


            ]);



        }
        $trick = $form->getData();

        // TODO: chercher l'id du trick puis chercher les image associé a l'id de ce trick

        $medias = $trick->getIllustration();

        return $this->render('Member/editTricks.html.twig', [
            'trickForm' => $form->createView(),
            'trick' => $trick

        ]);
    }



    /**
     * @Route(
     *     "delete/{id}",
     *     name="admin_trick_delete",
     *
     *     requirements={"id"="\d+"}
     * )
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        /* Delete Media */
        $MediaRepository = $this->getDoctrine()->getRepository(Media::class);
        $medias = $MediaRepository->findBy(array('tricks' => $id));
        foreach($medias as $media)
        {
            $entityManager->remove($media);
        }
        /* Delete Comment */
        $CommentRepository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $CommentRepository->findBy(array('Tricks' => $id));
        foreach($comments as $comment)
        {
            $entityManager->remove($comment);
        }
        /* Delete Tricks */
        $repository = $this->getDoctrine()->getRepository(Tricks::class);
        $trick = $repository->findOneBy(array('id' => $id));
        $entityManager->remove($trick);


        $entityManager->flush();
        $this->addFlash('info','This trick is deleted');


        return $this->redirectToRoute('home');
    }
}