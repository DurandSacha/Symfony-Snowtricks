<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Form\addTricksFormType;
use App\Service\Upload;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
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


class MediaController extends AbstractController
{

    /**
     * @Route(
     *     "image_delete/{id}",
     *     name="image_delete",
     * )
     */
    public function image_delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        /* Delete Media */
        $MediaRepository = $this->getDoctrine()->getRepository(Media::class);
        $medias = $MediaRepository->findOneBy(array('id' => $id));

        $entityManager->remove($medias);
        $entityManager->flush();
        $this->addFlash('info','Image deleted');

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    /*     must match "[^/]++    */
    /**
     * @Route(
     *     "embed_delete/{id}",
     *     name="embed_delete",
     * )
     */
    public function embed_delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        /* Delete Media */
        $MediaRepository = $this->getDoctrine()->getRepository(Media::class);
        $medias = $MediaRepository->findOneBy(array('id' => $id));

        $entityManager->remove($medias);
        $entityManager->flush();
        $this->addFlash('info','Embed Balise deleted');

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * @Route(
     *     "select_thumbnail/{id}/{trick}",
     *     name="select_thumbnail",
     * )
     */
    public function select_thumbnail($id,$trick)
    {
        // mettre a 0 toute les image.thumbnail lié au trick
        // mettre image $id thumbnail a 1

        $entityManager = $this->getDoctrine()->getManager();

        $TrickRepository = $this->getDoctrine()->getRepository(Tricks::class);
        $MediaRepository = $this->getDoctrine()->getRepository(Media::class);


        $tricks_id = $TrickRepository->findOneBy(array('id' => $trick));
        $medias = $MediaRepository->findBy(array('tricks' => $tricks_id));

        foreach($medias as $Illustration) {
            $Illustration->setThumbnail(false);
            $entityManager->persist($Illustration);
        }

        $media = $MediaRepository->findOneBy(array('id' => $id));
        $media->setThumbnail(true);
        $entityManager->persist($media);





        $entityManager->flush();

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

}