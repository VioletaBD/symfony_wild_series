<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProgramFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach(CategoryFixtures::CATEGORIES as $category){
            for($i = 0 ; $i < 5 ; $i++){
                $program = new Program();
                $program->setTitle('Titre du film ' . $i);
                $program->setSynopsis('Test');
                // $program->setCategory($this->getReference('category_' . $category));
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
