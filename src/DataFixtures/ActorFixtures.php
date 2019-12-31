<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


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
        //foreach (self::SEASONS as $seasonNumber)
        $faker = Faker\Factory::create('us_US');
        for ($i = 1; $i < 7; $i++) {
            for ($j = 1; $j < 10; $j++) {
                $actor = new Actor();
                $actor->setName ($faker->name());

                $actor->addProgram ($this->getReference ('program' . $i));

                $manager->persist ($actor);
            }
        }
        $manager->flush ();
    }
    public function getDependencies()

    {

        return [ProgramFixtures::class];

    }
/*
class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 50 actors
        for ($i = 0; $i < 50; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);

            $manager->persist($actor);
        foreach ($programs as $programTitle){
                $actor->addProgram($this->getReference($programTitle));

        }

        $manager->flush();
    }
    public function getDependencies()

    {

        return [ProgramFixtures::class];

    }*/
}
