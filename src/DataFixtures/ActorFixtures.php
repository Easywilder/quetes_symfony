<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Andrew Lincoln'=> ['Walking Dead','Fear The Walking Dead'],
        'Norman Reedus'=> ['Walking Dead'],
        'Lauren Cohan'=> ['Walking Dead'],
         'Danai Gurira'=> ['Walking Dead'],

    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $actorName=>$programs) {
            $actor = new Actor();
            $actor->setName ($actorName);
            foreach ($programs as $programTitle){
                $actor->addProgram($this->getReference($programTitle));
            }
            $manager->persist ($actor);
        }
        $manager->flush();
    }
    public function getDependencies()

    {

        return [ProgramFixtures::class];

    }
}
