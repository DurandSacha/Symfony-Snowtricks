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
        // CREATE MEDIA 1
        $media1 = new Media();
        $media1->setPath('demo/0.jpg');
        $media1->setType('Picture');
        $media1->setTexte('Hello World');
        $media1->setTricks($this->getReference(TrickFixture::TRICKS1_REFERENCE));

        $manager->persist($media1);

        // CREATE MEDIA 2
        $media2 = new Media();
        $media2->setPath('demo/1.jpg');
        $media2->setType('Picture');
        $media2->setTexte('Flip');

        $media2->setTricks($this->getReference(TrickFixture::TRICKS2_REFERENCE));
        $manager->persist($media2);

        // CREATE MEDIA 3
        $media3 = new Media();
        $media3->setPath('demo/2.jpg');
        $media3->setType('Picture');
        $media3->setTexte('Flip Fly');
        $media3->setTricks($this->getReference(TrickFixture::TRICKS1_REFERENCE));
        $manager->persist($media3);

        /* Generate image for 10 tricks */
        $media5 = new Media();
        $media5->setPath($this->faker->randomElement(self::$path));
        $media5->setType('Picture');
        $media5->setTexte('Its a factice automatic images');
        $media5->setTricks($this->getReference(TrickFixture::TRICKS11_REFERENCE));
        $manager->persist($media5);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS12_REFERENCE));
        $manager->persist($media4);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS13_REFERENCE));
        $manager->persist($media4);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS14_REFERENCE));
        $manager->persist($media4);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS15_REFERENCE));
        $manager->persist($media4);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS16_REFERENCE));
        $manager->persist($media4);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS17_REFERENCE));
        $manager->persist($media4);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS18_REFERENCE));
        $manager->persist($media4);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS19_REFERENCE));
        $manager->persist($media4);

        /* Generate image for 10 tricks */
        $media4 = new Media();
        $media4->setPath($this->faker->randomElement(self::$path));
        $media4->setType('Picture');
        $media4->setTexte('Its a factice automatic images');
        $media4->setTricks($this->getReference(TrickFixture::TRICKS20_REFERENCE));
        $manager->persist($media4);

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
