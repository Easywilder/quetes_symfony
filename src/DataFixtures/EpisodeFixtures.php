<?php


namespace App\DataFixtures;


use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
   const SEASONS = [
        1, 2, 3, 4, 5, 6
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $seasonNumber) {
            for ($i = 1; $i <= 20; $i++) {
                $episode = new Episode();
                $episode->setSeason ($this->getReference ($seasonNumber));
                $episode->setNumber ($i);
                $episode->setSynopsis ('synopsissynopsissynopsissynopsissynopsissynopsis');
                $manager->persist ($episode);
            }
        }
        $manager->flush();
    }

    public function getDependencies()

    {

        return [SeasonFixtures::class];

    }
}