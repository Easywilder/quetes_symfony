<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Season;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'Walking Dead',
        'American Horror Story',
        'Penny Dreadful',
        'The Haunting Of Hill House',
        'Love Death And Robots'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programTitle) {
            $beginning = rand (2010, 2020);
            for ($i = 1; $i <= rand(1, 10); $i++) {
                $season = new Season();
                $season->setProgram ($this->getReference ($programTitle));
                $season->setNumber ($i);
                $season->setYear ($beginning + $i);
                $season->setDescription ('ldldldlldldldldl');
                $manager->persist ($season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()

    {

        return [ProgramFixtures::class];

    }

}
