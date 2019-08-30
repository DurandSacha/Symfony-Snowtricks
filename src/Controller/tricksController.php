<?php
// src/Controller/tricksController.php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Form\addTricksFormType;
use App\Form\PictureFormType;
use App\Service\Upload;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\mediaController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\ParameterBag;


/**
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
        $formPicture = $this->createForm(PictureFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $PictureFile = $form->get('pictures')->getData();

            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            // Gestion IMAGE
            if($PictureFile){
                $type = 'Picture';

                // avoir tout les champ : image
                $medias = $form->get('pictures')->getData();

                $array = New ArrayCollection();
                $array->add($medias);
                $number = $array->count();


                var_dump($array);

                //compter le nombre de picture et persister

                for($i = 0; $i < count($number); $i++) {
                    var_dump($i);
                $media = $upload->addMedia($PictureFile);

                $media = New Media();
                $media->setPath('img/' . $PictureFile);
                $media->setType($type);
                $media->setTexte('A picture for a tricks');
                //$this->addReference('trick', $trick);
                $media->setTricks($trick);
                $trick->addIllustration($media);

                $this->em->persist($trick);
                $this->em->persist($media);

                }

            }





            // Gestion Embed


            $embedFile = $form->get('Embed')->getData();
            if ($embedFile)
            {
            $typeEmbed ='Embed';
            $embedMedia = $upload->addMedia($embedFile);
            $trick->addIllustration($embedMedia);
            }



            $this->em->flush();

            $this->addFlash('success', 'Tricks ' . $trick->getName() . ' is created');
            //return $this->redirectToRoute('trickList');
        }

        return $this->render('Member/addTricks.html.twig', [
            'addTricksForm' => $form->createView(),
            'pictureForm' => $formPicture->createView()
        ]);



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

            if (!empty($PictureFile)) {
                $type = 'Picture';
                $media = $upload->addMedia($PictureFile, $trick, $type);
                $trick->addIllustration($media);
            }


            $embedFile = $form->get('Embed')->getData();
            if (!empty($embedFile))
            {
                $typeEmbed ='Embed';
                $embedMedia = $upload->addMedia($embedFile,$trick,$typeEmbed);
                $trick->addIllustration($embedMedia);
            }


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