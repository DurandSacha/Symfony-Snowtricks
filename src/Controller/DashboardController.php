<?php
// src/Controller/DashboardController.php
/**
 * Created by PhpStorm.
 * User: sacha
 * Date: 12/06/2019
 * Time: 00:23
 */

namespace App\Controller;

use App\Form\UserPasswordFormType;
use App\Form\UserPictureFormType;
use App\Repository\TricksRepository;
use App\Repository\UserRepository;

use App\Service\Upload;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Tricks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * @IsGranted("ROLE_MEMBER")
 */
class DashboardController  extends BaseController
{

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(UserPasswordEncoderInterface $encoder, Request $request, Upload $upload, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserPictureFormType::class, $user);
        $form->handleRequest($request);
        $form2 = $this->createForm(UserPasswordFormType::class, $user);
        $form2->handleRequest($request);
        if ($form->isSubmitted()) {
            $PictureFile = $form->get('picture')->getData();
            if($PictureFile);{ $upload->upload($PictureFile); $user->setPicture($PictureFile);}
        }
        if ($form2->isSubmitted()) {
            $password = $encoder->encodePassword($user, $form2->get('password')->getData());
            $user->setPassword($password);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash( 'success', "Your profile is updated");
            return $this->redirectToRoute('login');
        }
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->render('Member/dashboard.html.twig',['UserPictureFormType' => $form->createView(), 'UserPasswordFormType' => $form2->createView(),
        ]);
    }
    /**
     * @Route("/trickList", name="trickList")
     */
    public function list(TricksRepository $tricksRepo)
    {
        $tricks = $tricksRepo->findAll();

        $user = $this->getUser();
        // Tester l'objet User pour voir s'il est vide
        if (null === $user) {
            $visitorName = 'Anonyme';
        } else {
            $visitorName = $user->getUsername();
        }

        return $this->render('Member/listTricks.html.twig', [
            'tricks' => $tricks,
            'visitorName' => $visitorName
        ]);
    }
}
