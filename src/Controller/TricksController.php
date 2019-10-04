<?php
// src/Controller/TricksController.php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Form\addTricksFormType;
use App\Form\PictureFormType;
use App\Service\Upload ;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
use Symfony\Component\Form\FormTypeExtensionInterface;

/**
 * @IsGranted("ROLE_MEMBER")
 */
class TricksController extends AbstractController
{
    public const TRICK_REFERENCE = 'trick';
    /**
    * @Route("/addTricks", name="admin_tricks_new")
    */
    public function add(Upload $upload, EntityManagerInterface $em, Request $request)
    {
        $trick = new Tricks();
        $form = $this->createForm(addTricksFormType::class,$trick);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setAuthor($this->getUser());
            foreach ($trick->getIllustration() as  $Illustration) {

                $fileName = $upload->upload($Illustration->getFile());
                $Illustration->setPath($fileName);
                $Illustration->setTricks($trick);
                if ($Illustration->getThumbnail() == True ){
                    $Illustration->setThumbnail(True);
                }
                else{
                    $Illustration->setThumbnail(False);
                }
                $em->persist($Illustration);
                $Illustration->setType('Picture');
                $Illustration->setTexte($Illustration->getTexte());

            }
            foreach ($form->get('Embed')->getData() as  $embed) {

                $video = New Media();
                $video->setPath($embed->getEmbed());
                $video->setTricks($trick);
                $em->persist($video);
                $video->setType('Embed');
                $video->setTexte('A Embed Balise');
            }
            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'Tricks ' . $trick->getName() . ' is created');
            return $this->redirectToRoute('home');
        }
        return $this->render('Member/addTricks.html.twig', [
            'addTricksForm' => $form->createView(),

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
            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            foreach ($tricks->getIllustration() as  $Illustration) {

                if(!$Illustration->getId()) {
                    $fileName = $upload->upload($Illustration->getFile());
                    $Illustration->setPath($fileName);
                    $Illustration->setTricks($trick);
                    $Illustration->setType('Picture');
                    $Illustration->setThumbnail(False);
                    $Illustration->setTexte($Illustration->getTexte());
                    $em->persist($Illustration);
                    $em->flush();
                }
            }
            foreach ($form->get('Embed')->getData() as  $embed) {

                $video = New Media();
                $video->setPath($embed->getEmbed());
                $video->setTricks($trick);
                $video->setType('Embed');
                $video->setTexte('A Embed Balise');
                $em->persist($video);
            }
            $em->flush();

            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');
            return $this->redirectToRoute('admin_article_edit', [
                'tricks' => $tricks->getId(),
            ]);

        }
        $trick = $form->getData();
        $mediaRepo = $em->getRepository(Media::class);
        $medias = $mediaRepo->findBy(array('tricks' => $trick->getId()));

        return $this->render('Member/editTricks.html.twig', [
            'addTricksForm' => $form->createView(),
            'trick' => $trick,
            'medias' => $medias

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
        $repository = $this->getDoctrine()->getRepository(Tricks::class);
        $trick = $repository->findOneBy(array('id' => $id));
        $entityManager->remove($trick);

        $entityManager->flush();
        $this->addFlash('info','This trick is deleted');

        return $this->redirectToRoute('home');
    }
}