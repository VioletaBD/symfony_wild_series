<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM_NUMBER = 5;
    
    public function load(ObjectManager $manager): void
    {
        foreach (CategoryFixtures::CATEGORIES as $categoryKey => $categoryName) {
            for ($i = 0; $i < ProgramFixtures::PROGRAM_NUMBER; $i++) {
                        $program = new Program();
                        $program->setTitle('name');
                        $program->setSynopsis($i);
                        $category = $this->getReference(
                            'category_' . $categoryKey
                        );
                        $category->setProgram($program);
                        $manager->persist($program);
                }
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
