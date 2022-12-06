<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASON_NUMBER = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (CategoryFixtures::CATEGORIES as $categoryKey => $categoryName) {
            for ($i = 0; $i < ProgramFixtures::PROGRAM_NUMBER; $i++) {
                for ($j = 0; $j < self::SEASON_NUMBER; $j++) {
                        $season = new Season();
                        $season->setNumber($faker->numberBetween(1, 5));
                        $season->setYear($faker->year());
                        $season->setDescription($faker->paragraph(3, true));
                        $program = $this->getReference(
                            'category_' . $categoryName . '_program_' . $i
                        );
                        $season->setProgram($program);
                        $this->addReference( 'category_' . $categoryName . '_program_' . $i . '_season_' .$j, $season);
                        $manager->persist($season);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()

    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ProgramFixtures::class,
        ];

    }
}
