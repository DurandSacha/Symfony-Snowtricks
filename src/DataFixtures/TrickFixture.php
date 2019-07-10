<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Tricks;
use App\DataFixtures\CategoryFixture;
use App\DataFixtures\UserFixture;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TrickFixture extends BaseFixture implements DependentFixtureInterface
{

    private static $trickAuthor = [
        'Mike Ferengi',
        'Amy Oort',
        'Sacha Durand',
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {

        $user5 = new User();
        $user5->setEmail('zzzzzz@gmail.com');
        $user5->setUsername('zzzzz');
        $user5->setPassword($this->passwordEncoder->encodePassword(
            $user5,
            '000000'
        ));
        $manager->persist($user5);

        $category = new Category();
        $category->setName('Flip');
        $category->setDescription('A Flip Category');
        $manager->persist($category);


        /* Create a Trick Fixture */
        $trick = new Tricks();
        $trick->setName($this->faker->randomElement(self::$trickAuthor));
        $trick->setDescription($this->faker->firstName);

        /* The Reference */
        $trick->setAuthor($this->addReference('author',$user5));
        $trick->setCategory($this->addReference('category',$category));
        $manager->persist($trick);



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
        return [UserFixture::class];
    }


}
