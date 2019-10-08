<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{

    public const ADMIN_USER_REFERENCE = 'User5';

    public const ADMIN_USER = 'User1';
    public const ADMIN_USER5 = 'User5';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {

        // setAuthor($this->faker->randomElement(self::$articleAuthors))
        // charger USER
        //  $this->createMany(Article::class, 10, function(Article $article, $count) {  }
        $user5 = new User();
        $user5->setEmail('helloaloha@gmail.com');
        $user5->setUsername('aloa');
        $user5->setPassword($this->passwordEncoder->encodePassword(
            $user5,
            '000000'
        ));
        $user5->setPicture('0.jpg');
        $this->addReference('User5',$user5);
        $manager->persist($user5);



        $user1 = new User();
        $user1->setEmail('sacha6623@gmail.com');
        $user1->setUsername('sacha');
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            '000000'
        ));
        $user1->setRoles(['ROLE_MEMBER']);
        $user1->setPicture('0.jpg');
        $this->addReference('User1',$user1);
        $manager->persist($user1);

        $manager->flush();



    }


}
