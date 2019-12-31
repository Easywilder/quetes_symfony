<?php


namespace App\DataFixtures;


use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('us_US');
        for ($i = 1; $i < 55; $i++) { //seasons
            for ($j = 1; $j < 20; $j++) {
                $episode = new Episode();
                $episode->setTitle ($faker->text(20));
                $episode->setSeason ($this->getReference ('season' . $i));
                $episode->setNumber ($j);
                $episode->setSynopsis ($faker->text(200));
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