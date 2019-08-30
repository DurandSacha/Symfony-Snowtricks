<?php
// src/Service/Upload.php
namespace App\Service;

use App\Entity\Media;
use App\Entity\Tricks;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

use Doctrine\Common\Persistence\ObjectManager;
//use Doctrine\ORM\EntityManagerInterface;


class Upload
{
    // mettre entity manager en construct
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addMedia($PictureFile )
    {
            $originalFilename = pathinfo($PictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $PictureFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $PictureFile->move('../public/img',
                    $newFilename
                );

            } catch (FileException $e) {
                $this->addFlash(
                    'info',
                    "a problem exist with your upload "
                );
            }

    }
}
