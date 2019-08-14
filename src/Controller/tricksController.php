<?php
// src/Controller/tricksController.php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Form\addTricksFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use App\Form\ArticleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;


/**
 * @IsGranted("ROLE_MEMBER")
 */
class tricksController extends AbstractController
{
    public const TRICK_REFERENCE = 'trick';

    /**
    * @Route("/addTricks", name="admin_tricks_new")
    */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(addTricksFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $PictureFile = $form->get('picture')->getData();

            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            // upload
            if($PictureFile);
            $originalFilename = pathinfo($PictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$PictureFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $PictureFile->move(
                    $this->getParameter('tricksImg_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                $this->addFlash(
                    'info',
                    "a problem exist with your upload "
                );
            }
            // Nouvel objet image
            $media = New Media();
            $media->setPath('img/'.$newFilename);
            $media->setType('Picture'); // comment savoir si c'est une vidéo ?
            $media->setTexte('A picture for a tricks');
            //$this->addReference('trick', $trick);
            $media->setTricks($trick);


            $em->persist($trick);
            $em->persist($media);
            $em->flush();

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
    public function edit(Tricks $tricks, Request $request, EntityManagerInterface $em)
    {


        $form = $this->createForm(addTricksFormType::class, $tricks);
        $form->handleRequest($request);

        $tricks->setAuthor($this->getUser());
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($tricks);
            $em->flush();
            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');
            return $this->redirectToRoute('admin_article_edit', [
                'tricks' => $tricks->getId(),

            ]);
        }
        return $this->render('Member/editTricks.html.twig', [
            'trickForm' => $form->createView(),

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