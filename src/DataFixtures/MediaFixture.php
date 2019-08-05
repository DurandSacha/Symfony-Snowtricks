<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Tricks;
use App\DataFixtures\CategoryFixture;
use App\DataFixtures\UserFixture;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MediaFixture extends BaseFixture implements DependentFixtureInterface
{
    public const TRICK_REFERENCE = 'trick';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {

        /*
        $media1 = new Media();
        $media1->setPath('img/1.jpg');
        $media1->setType('Picture');
        $media1->setTexte('Flip Back');


        //$this->addReference(self::TRICK_REFERENCE, $trick);  // COMMENT ACCEDER A L OBJET D UNE AUTRE CLASSE FIXTURE ?
        //$media1->setTricks($this->getReference(TrickFixture::TRICK_REFERENCE));

        $manager->persist($media1);

        $manager->flush();
        */

    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */

    public function getDependencies()
    {
        return [TrickFixture::class];
    }


}
