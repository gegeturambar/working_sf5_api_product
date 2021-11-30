<?php

namespace App\DataFixtures;

use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\CategoryFixtures;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function load(ObjectManager $manager)
    {
        $fruits = ['Pomme','Grenade','Fruit de la passion'];
        $vege = ['Epinards','Potiron','Haricots'];
        $cat = $this->categoryRepository->findOneBy(['name' => 'Fruits']);
        foreach($fruits as $fruit){
            $product = new Product();
            $product->setName($fruit)->setPrice(rand(1,100))->setStock(rand(0,10))->setCategory($cat);
            $manager->persist($product);
        }

        $cat = $this->categoryRepository->findOneBy(['name' => 'Vegetables']);
        foreach($vege as $veg){
            $product = new Product();
            $product->setName($veg)->setPrice(rand(1,100))->setStock(rand(0,10))->setCategory($cat);
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
