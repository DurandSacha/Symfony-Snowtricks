<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends BaseFixture implements DependentFixtureInterface
{
    public const ADMIN_USER_REFERENCE = 'user5';
    public const CATEGORY_REFERENCE = 'categoryFlip';
    public const TRICK_REFERENCE = 'trick';

    private static $comment = [
        'Funny' ,
        'Great Tricks',
        'Go to prepare this tricks in holliday !!',
        'good but its not easy',
        'Excellent, more information please',
        'Picture is attractive <3',
        'magnifico !! ',
        'bad tricks..',
        'cool ',
        'nice !! i try this after ',
        'i love a title of this trick ',
    ];



    protected function loadData(ObjectManager $manager)
    {

        for ($i = 1; $i <= 10; $i++) {
            $comment = new Comment();
            $comment->setContent($this->faker->randomElement(self::$comment));
            $comment->setUser($this->getReference('User1'));

            $comment->setTricks($this->getReference('trick'.$i));
            $comment->setCreatedAt(new \DateTime());
            $manager->persist($comment);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class,
            TrickFixture::class
        );

    }

}
