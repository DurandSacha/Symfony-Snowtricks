<?php
// src/Controller/dashboardController.php
/**
 * Created by PhpStorm.
 * User: sacha
 * Date: 12/06/2019
 * Time: 00:23
 */

namespace App\Controller;

use App\Form\UserPictureFormType;
use App\Repository\TricksRepository;
use App\Repository\UserRepository;

use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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


/**
 * @IsGranted("ROLE_MEMBER")
 */
class dashboardController  extends BaseController
{

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(AuthenticationUtils $authenticationUtils, LoggerInterface $logger, Request $request, UserRepository $userRepo){


        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $form = $this->createForm(UserPictureFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $PictureFile = $form->get('picture')->getData();



            if($PictureFile);
            $originalFilename = pathinfo($PictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$PictureFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $PictureFile->move(
                    $this->getParameter('userPicture_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                $this->addFlash(
                    'info',
                    "a problem exist with your upload "
                );
            }

            $user->setPicture($newFilename);
        }

            //$user->setPicture($PictureFile);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Your photo is upload now"
            );


        return $this->render('Member/dashboard.html.twig',[
            'UserPictureFormType' => $form->createView(),
        ]);
    }

    /**
     * @Route("/trickList", name="trickList")
     */
    public function list(TricksRepository $tricksRepo)
    {
        $tricks = $tricksRepo->findAll();

        return $this->render('Member/listTricks.html.twig', [
            'tricks' => $tricks,

        ]);
    }
}
