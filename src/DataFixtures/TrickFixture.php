<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Tricks;
use App\Entity\Media;
use App\DataFixtures\CategoryFixture;
use App\DataFixtures\UserFixture;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class TrickFixture extends BaseFixture implements DependentFixtureInterface
{

    public const ADMIN_USER_REFERENCE = 'main_users';
    public const ADMIN_USER_REFERENCE2 = 'other_users';
    public const CATEGORY_REFERENCE = 'category';
    public const TRICK_REFERENCE = 'trick';
    public const TRICK_REFERENCE2 = 'trick2';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {

        // charger USER
        $user5 = new User();
        $user5->setEmail('zzzzzz@gmail.com');
        $user5->setUsername('zzzzz');
        $user5->setPassword($this->passwordEncoder->encodePassword(
            $user5,
            '000000'
        ));
        $manager->persist($user5);

        $user1 = new User();
        $user1->setEmail('sacha6623@gmail.com');
        $user1->setUsername('sacha');
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            '000000'
        ));
        $user1->setRoles(['ROLE_MEMBER']);
        $manager->persist($user1);

        $category = new Category();
        $category->setName('Flip');
        $category->setDescription('Its a backflip trick snow, you can learn this on all condition. Please take picture if you make this trick');
        $manager->persist($category);


        /* Create a Trick Fixture */
        $trick = new Tricks();
        $trick->setName('BackFlip');
        $trick->setDescription('Its a backflip trick snow, you can learn this on all condition. Please take picture if you make this trick');

        /* The Reference */
        $this->addReference(self::ADMIN_USER_REFERENCE, $user1);
        $trick->setAuthor($this->getReference(UserFixture::ADMIN_USER_REFERENCE));

        $this->addReference(self::CATEGORY_REFERENCE, $category);
        $trick->setCategoryTricks($this->getReference(CategoryFixture::CATEGORY_REFERENCE));
        $manager->persist($trick);







        /* Create a Trick Fixture */
        $trick2 = new Tricks();
        $trick2->setName('Flip');
        $trick2->setDescription('Its a backflip trick snow, you can learn this on all condition. Please take picture if you make this trick');

        /* The Reference */
        $trick2->setAuthor($this->getReference(UserFixture::ADMIN_USER_REFERENCE));
        $trick2->setCategoryTricks($this->getReference(CategoryFixture::CATEGORY_REFERENCE));
        $manager->persist($trick2);



        // CREATE MEDIA 1
        $media1 = new Media();
        $media1->setPath('img/0.jpg');
        $media1->setType('Picture');
        $media1->setTexte('Hello World');

        $this->addReference('trick', $trick);
        $media1->setTricks($this->getReference(TrickFixture::TRICK_REFERENCE));

        $manager->persist($media1);

        // CREATE MEDIA 2
        $media2 = new Media();
        $media2->setPath('img/1.jpg');
        $media2->setType('Picture');
        $media2->setTexte('Flip');
        $this->addReference(self::TRICK_REFERENCE2, $trick2);
        $media2->setTricks($this->getReference(TrickFixture::TRICK_REFERENCE2));
        $manager->persist($media2);

        // CREATE MEDIA 3
        $media3 = new Media();
        $media3->setPath('img/2.jpg');
        $media3->setType('Picture');
        $media3->setTexte('Flip Fly');
        $media3->setTricks($this->getReference(TrickFixture::TRICK_REFERENCE2));
        $manager->persist($media3);


        /* CREATE COMMENT */
        $comment = new Comment();
        $comment->setContent('Funny SnowTricks man, great and Good luck ! ');
        //$comment->setDate(date('Y:m:d '));
        $comment->setUser($this->getReference(UserFixture::ADMIN_USER_REFERENCE));
        $comment->setTricks($this->getReference(TrickFixture::TRICK_REFERENCE));
        $manager->persist($comment);


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
