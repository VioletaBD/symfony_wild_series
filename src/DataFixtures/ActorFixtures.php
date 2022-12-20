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

        for ($i = 0; $i < self::ACTORS; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            $programByActor = self::SERIES_BY_ACTOR;
            $this->addReference('actor_' . $i, $actor);
            for ($j = 0; $j < $programByActor; $j++) {
                $actor->addProgram($this->getReference('category_' . CategoryFixtures::CATEGORIES[$faker->numberBetween(0, 4)] . '_program_' . $faker->numberBetween(1, 3)));
            }
            $manager->persist($actor);

            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class
        ];
    }
}
