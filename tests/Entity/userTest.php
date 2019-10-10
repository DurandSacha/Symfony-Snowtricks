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

    public function testUserUsername()
    {
        $this->user->setUsername('sacha');
        $this->assertEquals('sacha', $this->user->getUsername());
    }

    public function testUserToken()
    {
        $this->user->setToken('XXX');
        $this->assertEquals('XXX', $this->user->getToken());
    }

    public function testUserRole()
    {
        $roles[] = 'ROLE_USER';
        $this->user->setRoles($roles);
        $this->assertEquals($roles, $this->user->getRoles());
    }

    public function testUserPassword()
    {
        $this->user->setPassword('abcdef');
        $this->assertEquals('abcdef', $this->user->getPassword());
    }

}