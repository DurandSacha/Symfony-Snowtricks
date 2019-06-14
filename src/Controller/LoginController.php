<?php

namespace App\Controller;

use App\Form\changePasswordForm;
use App\Form\resetForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use App\Entity\User;
use App\Form\RegistrationFormType;




class LoginController extends AbstractController
{


    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    public function logout()
    {

        return $this->redirectToRoute('home');
    }

    /**
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return mixed
     * @throws \Exception
     */
    public function reset(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(resetForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            // Generer un token et associer le token a ce compte
            $token = bin2hex(random_bytes(13));

            $entityManager = $this->getDoctrine()->getManager();

            $repository = $this->getDoctrine()->getRepository(User::class);

            $user = $repository->findOneBy(array('email' => $form->get('Email')->getData())); // trouver l'adresse mail POST du FORM

            $user->setToken($token);

            $entityManager->persist($user);
            $entityManager->flush();

            $mailtarget =  $form->get('Email')->getData();  // avoir l'email de l'utilisateur Formulaire //

            $message = (new \Swift_Message('SnowTricks Message'))
                ->setFrom('sacha6623@gmail.com')
                ->setTo($mailtarget)
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emails/token.html.twig',
                        [
                            'token' => $token,
                            'user' => $user
                            ]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);

            // fin mail
            $this->addFlash('info', "Email has been send");



        }
        return $this->render('security/reset.html.twig', [
            'resetForm' => $form->createView(),
        ]);

    }
    public function resetNow(Request $request, UserPasswordEncoderInterface $encoder, $token)
    {

        $repository = $this->getDoctrine()->getRepository(User::class);
        $entityManager = $this->getDoctrine()->getManager();


        $user = $repository->findOneBytoken($token);

        $form = $this->createForm(changePasswordForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if($user->getToken() === $token) {


                $password = $encoder->encodePassword($user, $form->get('plainPassword')->getData());
                $user->setPassword($password);
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    "Mot de passe modifié avec succès !"
                );
                return $this->redirectToRoute('login');
            }
            else
            {
                $this->addFlash(
                    'info',
                    "La modification du mot de passe a échoué ! Le lien de validation a expiré !"
                );
            }
        }

        return $this->render('security/changePassword.html.twig', [
            'changePasswordForm' => $form->createView(),
        ]);

    }




}
