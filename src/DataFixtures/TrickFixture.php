<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TrickFixture extends BaseFixture
{

    private static $trickAuthor = [
        'Mike Ferengi',
        'Amy Oort',
        'Sacha Durand',
    ];

    public function __construct()
    {

    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(7, 'tricks', function($i) {
            $trick = new Tricks();
            $trick->setName($this->faker->randomElement(self::$trickAuthor));
            $trick->setDescription($this->faker->firstName);
            //$trick->setCategory($this->faker->numberBetween(0, 3));
            //$trick->setComment($this->faker->company);


            return $trick;
        });



        $manager->flush();
    }
}
