<?php

namespace Tests\Entity;

use App\Entity\Media;
use App\Entity\Tricks;
use PHPUnit\Framework\TestCase;

class trickTest extends TestCase
{
    // Test the UnitFunction method in the Trick entity
    public function testUnitFunction()
    {
        $trick = new Tricks();

        $one = 2 ;
        $this->assertSame($one * 2, $trick->UnitFunction($one)); // ( resultat attendu, code executé )
    }

}