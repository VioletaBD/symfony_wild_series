<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)

    {

        $program = new Program();

        $program->setTitle('Walking dead');

        $program->setSynopsis('Des zombies envahissent la terre');

        $program->setCategory($this->getReference('category_Action'));

        $manager->persist($program);

        $manager->flush();

    }


    public function getDependencies()

    {

        return [

          CategoryFixtures::class,

        ];

    }
    // public function load(ObjectManager $manager): void
    // {
    // //     foreach(CategoryFixtures::CATEGORIES as $category){
    // //         for($i = 0 ; $i < 5 ; $i++){
    // //             $program = new Program();
    // //             $program->setTitle('Titre du film ' . $i);
    // //             $program->setSynopsis('This is test');
    // //             $program->setCategory($this->getReference('category_' . $category));
    // //             $manager->persist($program);
    // //         }
    // //     }
    // //     $manager->flush();
    // // }
    // // public function getDependencies()
    // // {
    // //     return [
    // //         CategoryFixtures::class,
    // //     ];
    // // }
}
