<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Episode;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i = 0; $i < 50; $i++) {

            $episode = new Episode();

            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setTitle($faker->title());
            $episode->setNumber($faker->number());
            $episode->setSynopsis($faker->paragraphs(3, true));

            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(0, 5)));

            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()

    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          SeasonFixtures::class,
        ];
    }

}
