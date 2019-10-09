<?php
namespace App\tests;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use PHPUnit\Framework\TestCase;


class userTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function testUserMail()
    {
        $this->user->setEmail('test@gmail.fr');
        $this->assertEquals('test@gmail.fr', $this->user->getEmail());
    }



}