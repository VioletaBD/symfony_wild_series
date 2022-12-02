<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM_LOOP = 5;
    
    public function load(ObjectManager $manager): void
    {
        foreach(CategoryFixtures::CATEGORIES as $key => $category){
          for($i = 0 ; $i < 5 ; $i++){
        $program = new Program();
        $program->setTitle('Titre du film ' . $i);
        $program->setSynopsis('This is test');
        $program->setCategory($this->getReference('category_' . $category));
        $this->addReference('program_' . $key .$i, $program);
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
