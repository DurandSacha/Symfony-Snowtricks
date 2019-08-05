<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    public const ADMIN_USER_REFERENCE = 'main_users';


    private $passwordEncoder;

    private static $mail = [
        'yyy@gmail.com',
        'y2y@gmail.com',
        'aaaaa@gmail.com',
        'ppppp@gmail.com',
        '777774@gmail.com',
        '888888@gmail.com',
        'aaaaa@gmail.com',
        'bbb@gmail.com',
        'ccccc@gmail.com',
        'ddddd@gmail.com',
        'eeeee@gmail.com',
        'ffff@gmail.com',
        'uuuuuu@gmail.com',
        'zzzzz@gmail.com',
    ];

    private static $firstName =[
        'yohann',
        'jean',
        'pierre',
        'marie',
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {


        $this->createMany(10, 'main_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('test%d@example.com', $i));
            $user->setUsername($this->faker->firstName);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
            return $user;
        });



        $user1 = new User();
        $user1->setEmail('sacha6623@gmail.com');
        $user1->setUsername('sacha');
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            '000000'
        ));
        $user1->setRoles(['ROLE_MEMBER']);
        $manager->persist($user1);


        $manager->flush();
    }
}
