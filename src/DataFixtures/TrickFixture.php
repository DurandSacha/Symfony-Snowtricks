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

    public const ADMIN_USER_REFERENCE = 'main_users';
    public const CATEGORY_REFERENCE = 'category';

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
        $trick->setName('Flip');
        $trick->setDescription('A trick Flip');

        /* The Reference */
        $this->addReference(self::ADMIN_USER_REFERENCE, $user5);
        $trick->setAuthor($this->getReference(UserFixture::ADMIN_USER_REFERENCE));

        $this->addReference(self::CATEGORY_REFERENCE, $category);
        $trick->setCategoryTricks($this->getReference(CategoryFixture::CATEGORY_REFERENCE));
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
