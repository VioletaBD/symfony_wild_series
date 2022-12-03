<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\DataFixtures\ProgramFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODE_NUMBER = 10;

    public function load(ObjectManager $manager): void
    {
        foreach (CategoryFixtures::CATEGORIES as $categoryKey => $categoryName) {
            for ($i = 0; $i < ProgramFixtures::PROGRAM_NUMBER; $i++) {
                for ($j = 0; $j < SeasonFixtures::SEASON_NUMBER; $j++) {
                    for ($episodeKey = 0; $episodeKey < self::EPISODE_NUMBER; $episodeKey++) {
                        $episode = new Episode();
                        $episode->setTitle('episode');
                        $episode->setNumber($episodeKey + 1);
                        $season = $this->getReference(
                            'category_' . $categoryKey . '_program_' . $i . 'season_' . $j
                        );
                        $episode->setSeason($season);
                        $manager->persist($episode);
                    }
                }
            }
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
