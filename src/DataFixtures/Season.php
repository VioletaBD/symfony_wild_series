<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Season extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $programs = new Program();
        $manager->persist($programs);

        $manager->flush();
    }
}
