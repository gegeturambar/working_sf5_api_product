<?php

namespace App\DataFixtures;

use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\CategoryFixtures;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File;

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
            $src = __DIR__.'/Resources/img.png';
/*
            $file = new UploadedFile(
                $src,
                'animg.png',
                'application/png',
                filesize($src),
                true // Set test mode true !!! " Local files are used in test mode hence the code should not enforce HTTP uploads."
            );
            $product->file = $file;
*/
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
