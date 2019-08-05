<?php
// src/Controller/tricksController.php

namespace App\Controller;

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
    /**
    * @Route("/addTricks", name="admin_tricks_new")
    */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(addTricksFormType::class);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'Tricks ' . $trick->getName() . ' is created');

            return $this->redirectToRoute('trickList');
        }

        return $this->render('Member/addTricks.html.twig', [
            'addTricksForm' => $form->createView(),
        ]);
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
     * @Route("/delete/{id}", name="admin_trick_delete", requirements={"id" = "\d+"})
     */
    public function delete($id)
    {
        // requete de suppression
    }
}