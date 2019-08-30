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
    public const TRICKS1_REFERENCE = 'trick';
    public const TRICKS2_REFERENCE = 'trick2';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {

        //$this->addReference($this->getReference(CategoryFixture::CATEGORY_REFERENCE));


        // CREATE MEDIA 1
        $media1 = new Media();
        $media1->setPath('img/demo/0.jpg');
        $media1->setType('Picture');
        $media1->setTexte('Hello World');
        $media1->setTricks($this->getReference(TrickFixture::TRICKS1_REFERENCE));

        $manager->persist($media1);

        // CREATE MEDIA 2
        $media2 = new Media();
        $media2->setPath('img/demo/1.jpg');
        $media2->setType('Picture');
        $media2->setTexte('Flip');

        $media2->setTricks($this->getReference(TrickFixture::TRICKS2_REFERENCE));
        $manager->persist($media2);

        // CREATE MEDIA 3
        $media3 = new Media();
        $media3->setPath('img/demo/2.jpg');
        $media3->setType('Picture');
        $media3->setTexte('Flip Fly');
        $media3->setTricks($this->getReference(TrickFixture::TRICKS1_REFERENCE));
        $manager->persist($media3);

        $manager->flush();

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
