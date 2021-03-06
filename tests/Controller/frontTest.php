<?php
/**
 * Created by PhpStorm.
 * User: sacha
 * Date: 10/10/2019
 * Time: 00:32
 */

namespace App\Tests\Controller;

use App\Entity\Media;
use App\Entity\Tricks;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class frontTest extends WebTestCase {

    public function setUp()
    {

    }

    public function testHomepage()
    {
        $client = static::createClient();

        $client->request('GET','/');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testLearnPage()
    {
        $client = static::createClient();

        $client->request('GET','/learn');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }



    public function testSinglePage()
    {
        $client = static::createClient();
        $client->request('GET','/single/2');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }





}