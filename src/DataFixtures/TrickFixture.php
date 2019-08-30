<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Tricks;
use App\Entity\Media;
use App\DataFixtures\CategoryFixture;

use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class TrickFixture extends BaseFixture implements DependentFixtureInterface
{

    public const ADMIN_USER = 'User1';
    //public const ADMIN_USER5 = 'User5';
    public const ADMIN_USER_REFERENCE = 'User5';
    public const CATEGORY_REFERENCE = 'categoryFlip';

    public const TRICK_REFERENCE = 'trick';
    public const TRICK_REFERENCE2 = 'trick2';

    public const TRICKS1_REFERENCE = 'trick';
    public const TRICKS2_REFERENCE = 'trick2';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {

        /* Create a Trick Fixture */
        $trick = new Tricks();
        $trick->setName('BackFlip');
        $trick->setDescription('Its a backflip trick snow, you can learn this on all condition. Please take picture if you make this trick');
        $trick->setAuthor($this->getReference(UserFixture::ADMIN_USER));
        $trick->setCategoryTricks($this->getReference(CategoryFixture::CATEGORY_REFERENCE));
        $this->addReference('trick',$trick);
        $manager->persist($trick);




        /* Create a Trick Fixture */
        $trick2 = new Tricks();
        $trick2->setName('Flip');
        $trick2->setDescription('Its a backflip trick snow, you can learn this on all condition. Please take picture if you make this trick');

        /* The Reference */
        $trick2->setAuthor($this->getReference(UserFixture::ADMIN_USER));
        $trick2->setCategoryTricks($this->getReference(CategoryFixture::CATEGORY_REFERENCE));
        $this->addReference('trick2',$trick2);
        $manager->persist($trick2);



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
        return array(
            UserFixture::class,
            CategoryFixture::class
        );
    }


}
