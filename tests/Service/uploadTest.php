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
use App\Service\Upload;

class uploadTest extends WebTestCase {

    public function testUpload()
    {
        $this->assertEquals(0,0);
    }
}