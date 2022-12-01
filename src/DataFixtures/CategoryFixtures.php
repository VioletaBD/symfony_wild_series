<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach(self::CATEGORIES as $categoryName){
            for ($i = 1; $i <= 50; $i++) {
            $category = new Category();
            $category->setName($categoryName);

            $manager->persist($category);
            $this->addReference('category_' . $categoryName, $category);
        }
    }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
