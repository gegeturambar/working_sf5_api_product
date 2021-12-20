<?php

namespace App\DataFixtures;

use App\Entity\MediaObject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MediaObjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*
        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;
        // $manager->persist($product);

        $manager->flush();
        */
    }
}
