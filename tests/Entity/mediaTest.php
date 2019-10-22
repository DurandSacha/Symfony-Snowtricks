<?php
namespace App\tests;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use PHPUnit\Framework\TestCase;


class mediaTest extends TestCase
{
    private $media;

    public function setUp()
    {
        $this->media = new Media();
    }

    public function testPath()
    {
        $this->media->setPath('img/01.jpg');
        $this->assertEquals('img/01.jpg', $this->media->getPath());
    }

    public function testThumbnail()
    {
        $this->media->setThumbnail(true);
        $this->assertEquals(true, $this->media->getThumbnail());
    }

    public function testType()
    {
        $this->media->setType('picture');
        $this->assertEquals('picture', $this->media->getType());
    }

    public function testTrick()
    {
        $trick = new Tricks();
        $this->media->setTricks($trick);
        $this->assertEquals($trick, $this->media->getTricks());
    }

    public function testFile()
    {
        $this->media->setFile('filePath');
        $this->assertEquals('filePath', $this->media->getFile());
    }

    public function testTexte()
    {
        $this->media->setTexte('hello');
        $this->assertEquals('hello', $this->media->getTexte());
    }
}