<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Fruits');
        $manager->persist($category);
        $category = new Category();
        $category->setName('Vegetables');
        $manager->persist($category);
        $manager->flush();
    }
}
