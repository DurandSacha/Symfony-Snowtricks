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

    public $admin = 'User1';
    public $member = 'User5';
    public const CATEGORY_REFERENCE = 'categoryFlip';

    public $trick = 'trick';


    private $passwordEncoder;

    private static $name = [
        'Front Flip',
        'Back Flip',
        'Flip',
        '630 Back Flip',
        'Nose Grab',
        'Seat Belt',
        'Truck Driver',
        'Mute',
        'Sad Flip',
        'Style Week',
        'Mac Twist',
        'Hakon Flip',
        'Nose Slide',
        'Tail Slide',
        'Indie Slide',
        'Seat Grab',
        'Grab Line',
        'Old School Flip',
        'Japan Air',
        'Rocket Air ',
    ];

    private static $description = [
        'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique' ,
        'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week',
        'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.',
        'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.',
        'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series',
        'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.',
        'Les figures de snowboard sont toutes compliquées, mais celle-ci ne devrait pas vous posez trop de probleme. Même si vous débutez dans cette discipline.',
        'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.',
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {

        // setAuthor($this->faker->randomElement(self::$articleAuthors))
        for ($i = 1; $i <= 27; $i++) {
            $trick = new Tricks();
            $trick->setName($this->faker->randomElement(self::$name));
            $trick->setDescription($this->faker->randomElement(self::$description));
            $trick->setAuthor($this->getReference(UserFixture::ADMIN_USER));
            $trick->setCategoryTricks($this->getReference(CategoryFixture::CATEGORY_REFERENCE));

            $this->addReference('trick'.$i ,$trick);
            $manager->persist($trick);
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
        return array(
            UserFixture::class,
            CategoryFixture::class
        );
    }


}
