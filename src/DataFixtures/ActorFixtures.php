<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    const ACTORS = [
        'Emilia Clarke',
        'Sophie Turner',
        'Jason Momoa',
        'Kit Harington',
        'Peter Dinklage'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::ACTORS as $keyActor => $actorName) {
        $actor = new Actor();
        $actor->setName('$actorName');
        $manager->persist($actor);
        }
        $manager->flush();
    }
}
