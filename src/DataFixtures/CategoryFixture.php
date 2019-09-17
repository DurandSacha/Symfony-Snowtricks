<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CategoryFixture extends BaseFixture
{

    public const CATEGORY_REFERENCE = 'categoryFlip';


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


        $category = new Category();
        $category->setName('Flip');
        $category->setDescription('Its a backflip trick snow, you can learn this on all condition. Please take picture if you make this trick');
        $manager->persist($category);
        $this->addReference('categoryFlip',$category);


        $category2 = new Category();
        $category2->setName('Grab');
        $category2->setDescription('Its a hard trick snow, you can learn this on all condition. Please take picture if you make this trick');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Slides');
        $category3->setDescription('This is a Air Tricks');
        $manager->persist($category3);

        $category3 = new Category();
        $category3->setName('One Foot Tricks');
        $category3->setDescription('category for beginners');
        $manager->persist($category3);
        

        $manager->flush();
    }




}
