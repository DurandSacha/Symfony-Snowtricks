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
    public const TRICKS3_REFERENCE = 'trick3';

    public const TRICKS10_REFERENCE = 'trick10';
    public const TRICKS11_REFERENCE = 'trick11';
    public const TRICKS12_REFERENCE = 'trick12';
    public const TRICKS13_REFERENCE = 'trick13';
    public const TRICKS14_REFERENCE = 'trick14';
    public const TRICKS15_REFERENCE = 'trick15';
    public const TRICKS16_REFERENCE = 'trick16';
    public const TRICKS17_REFERENCE = 'trick17';
    public const TRICKS18_REFERENCE = 'trick18';
    public const TRICKS19_REFERENCE = 'trick19';
    public const TRICKS20_REFERENCE = 'trick20';

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
        for ($i = 1; $i <= 10; $i++) {
            $a = $i + 10;   // Beggining the reference at trick10
            $trick = new Tricks();
            $trick->setName($this->faker->randomElement(self::$name));
            $trick->setDescription($this->faker->randomElement(self::$description));
            $trick->setAuthor($this->getReference(UserFixture::ADMIN_USER));
            $trick->setCategoryTricks($this->getReference(CategoryFixture::CATEGORY_REFERENCE));
            $this->addReference('trick' . $a ,$trick);
            $manager->persist($trick);
        }



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
