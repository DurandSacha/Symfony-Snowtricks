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

    private static $path = [
        'demo/0.jpg',
        'demo/1.jpg',
        'demo/2.jpg',
        'demo/3.jpg',
        'demo/4.jpg',
        'demo/5.jpg',
        'demo/6.jpg',
        'demo/7.jpg',
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        for ($i = 1; $i <= 27; $i++) {
            // CREATE MEDIA 1
            $media1 = new Media();
            $media1->setPath($this->faker->randomElement(self::$path));
            $media1->setType('Picture');
            $media1->setTexte('Hello World'.$i);
            $media1->setTricks($this->getReference('trick'.$i));
            $media1->setThumbnail(True);

            $manager->persist($media1);
        }

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
