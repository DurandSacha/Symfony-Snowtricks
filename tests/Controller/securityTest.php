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

class securityTest extends WebTestCase
{

    public function setUp()
    {

    }

    public function testHomepage()
    {
        $client = static::createClient();

        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testRegister()
    {
        $client = static::createClient();

        $client->request('GET', '/register');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testReset()
    {
        $client = static::createClient();

        $client->request('GET', '/reset');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testApiAccount()
    {
        $client = static::createClient();

        $client->request('GET', '/api/account');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    /*
    public function testLogout()
    {
        $client = static::createClient();

        $client->request('GET', '/logout');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
    */



}