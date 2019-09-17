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



    protected function loadData(ObjectManager $manager)
    {
        /* CREATE COMMENT */
        $comment = new Comment();
        $comment->setContent('Funny SnowTricks man, great and Good luck ! ');
        //$comment->setDate(date('Y:m:d '));
        $comment->setUser($this->getReference(UserFixture::ADMIN_USER_REFERENCE));
        $comment->setTricks($this->getReference(TrickFixture::TRICK_REFERENCE));
        $comment->setCreatedAt(new \DateTime());
        $manager->persist($comment);

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
