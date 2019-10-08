<?php
namespace App\tests;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use PHPUnit\Framework\TestCase;


class trickTest extends TestCase
{
    private $trick;

    public function setUp()
    {
        $this->trick = new tricks;
    }

    public function testTrickId()
    {
        $this->trick->setId('1');
        $this->assertEquals('1', $this->trick->getId());
    }

    public function testTrickName()
    {
        $this->trick->setName('TrickName');
        $this->assertEquals('TrickName', $this->trick->getName());
    }

    public function testTrickAuthor()
    {
        $user = new User();
        $this->trick->setAuthor($user);
        $this->assertEquals($user, $this->trick->getAuthor());
    }

    public function testTrickCategory()
    {
        $category = new Category();
        $this->trick->setCategoryTricks($category);
        $this->assertEquals($category, $this->trick->getCategoryTricks());
    }

    public function testTrickIllustration()
    {
        $this->assertEquals(0,  count($this->trick->getIllustration()));
        $media = new Media();
        $this->trick->addIllustration($media);

        $this->assertEquals(1,  count($this->trick->getIllustration()));
        $this->trick->removeIllustration($media);
        $this->assertEquals(0,  count($this->trick->getIllustration()));
    }

    public function testTrickCommentaire()
    {
        $this->assertEquals(0,  count($this->trick->getComments()));
        $comment = new Comment();
        $this->trick->addComment($comment);
        $this->assertEquals(1,  count($this->trick->getComments()));
        $this->trick->removeComment($comment);
        $this->assertEquals(0,  count($this->trick->getComments()));
    }

}