<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Actor;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public const ACTORS = 10;
    public const SERIES_BY_ACTOR = 3;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (CategoryFixtures::CATEGORIES as $category => $categoryName) {
            for ($i = 0; $i < ProgramFixtures::PROGRAM_NUMBER; $i++) {
                for ($iActor = 1; $iActor < self::ACTORS; $iActor++) {
                    $name = $faker->lastName() . ' ' . $faker->firstName();
                    $actor = new Actor();
                    $actor->setName($name);
                    for ($j = 1; $j < self::SERIES_BY_ACTOR; $j++) {
                        $program = $this->getReference('category_' . $categoryName . '_program_' . $i);
                        $actor->addProgram($program);
                        $manager->persist($actor);
                    }
                }
                $manager->flush();
            }
        }
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class
        ];
    }
}
