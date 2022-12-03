<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASON_NUMBER = 5;

    public function load(ObjectManager $manager): void
    {
        foreach (CategoryFixtures::CATEGORIES as $categoryKey => $categoryName) {
            for ($i = 0; $i < ProgramFixtures::PROGRAM_NUMBER; $i++) {
                for ($j = 0; $j < SeasonFixtures::SEASON_NUMBER; $j++) {
                        $season = new Season();
                        $season->setNumber($j + 1);
                        $season->setYear('');
                        $season->setDescription($j);
                        $program = $this->getReference(
                            'category_' . $categoryKey . '_program_' . $i
                        );
                        $season->setProgram($program);
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
