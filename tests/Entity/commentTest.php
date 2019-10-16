<?php
namespace App\tests;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use PHPUnit\Framework\TestCase;


class commentTest extends TestCase
{
    private $comment;

    public function setUp()
    {
        $this->comment = new Comment();
    }

    public function testContent()
    {
        $this->comment->setContent('hello world');
        $this->assertEquals('hello world', $this->comment->getContent());
    }

    public function testCommentUser()
    {
        $user = new User();
        $this->comment->setUser($user);
        $this->assertEquals($user, $this->comment->getUser());
    }

    public function testCommentTrick()
    {
        $trick = new Tricks();
        $this->comment->setTricks($trick);
        $this->assertEquals($trick, $this->comment->getTricks());
    }

}