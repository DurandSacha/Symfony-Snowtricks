<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixture extends BaseFixture
{

    private static $name = [
        'Flip',
        'Beginners Tricks',
        'Air Tricks',
        'Altitude Tricks',
        'Tricks without snow',
        'easy Tricks',
        'Hard Tricks',
        'Spectacular Tricks',
        'Tricks for men',
        'Tricks with a high materials',
    ];

    private static $description = [
        'A flip category',
        'its a Beginners Tricks',
        'A category for Air Tricks',
        'Altitude Tricks',
        'A category for a low tricks levels',
    ];

    public function __construct()
    {
    }

    public function loadData(ObjectManager $manager)
    {

        /*
        $this->createMany(4, 'tricks', function($i)  {
            $category = new Category();
            $category->setName($this->faker->randomElement(self::$name));
            $category->setDescription($this->faker->randomElement(self::$description));

            return $category;
        });
        */

        $manager->flush();
    }


}
