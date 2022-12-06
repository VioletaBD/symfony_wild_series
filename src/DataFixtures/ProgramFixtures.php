<?php

namespace App\DataFixtures;

use Faker\Factory;
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
        $faker = Factory::create();
        $programKey = 1;

        foreach (CategoryFixtures::CATEGORIES as $category => $categoryName) {
            for ($i = 0; $i < self::PROGRAM_NUMBER; $i++) {
                        $program = new Program();
                        $program->setTitle($faker->sentence(2, true));
                        $program->setSynopsis($faker->paragraph(3, true));
                        $category = $this->getReference(
                            'category_' . $categoryName
                        );
                        $this->addReference('category_' . $categoryName . '_program_' . $i, $program);
                        $program->setCategory($category);
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
