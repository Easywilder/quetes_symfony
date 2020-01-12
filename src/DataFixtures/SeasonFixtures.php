<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Season;
use Faker;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $compteur = 1;
        $faker = Faker\Factory::create('us_US');
        for ($j = 1; $j < 7; $j++){
            $beginning = rand (2010, 2020);
            for ($i = 1; $i <= 10; $i++) {
                $season = new Season();
                $season->setProgram ($this->getReference ('program' . $j));
                $season->setNumber ($i);
                $season->setYear ($beginning + $i);
                $season->setDescription ($faker->text(200));
                $manager->persist ($season);
                $this->addReference ('season' . $compteur, $season);
                $compteur ++;
            }
        }
        $manager->flush();
    }

    public function getDependencies()

    {

        return [ProgramFixtures::class];

    }

}
