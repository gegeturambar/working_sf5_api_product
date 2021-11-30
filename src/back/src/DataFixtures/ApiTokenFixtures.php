<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApiTokenFixtures extends Fixture implements DependentFixtureInterface
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();
        foreach($users as $user){
            $token = new ApiToken($user);
            $manager->persist($token);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }


}
