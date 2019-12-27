<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        1 => ['Walking Dead'], ['American Horror Story'], ['Penny Dreadful'], ['The Haunting Of Hill House'], ['Love Death And Robots'],
        2 => ['Walking Dead'], ['American Horror Story'], ['Penny Dreadful'],
        3 => ['Walking Dead'], ['American Horror Story'], ['Penny Dreadful'],
        4 => ['Walking Dead'], ['American Horror Story'],
        5 => ['Walking Dead'], ['American Horror Story'],
        6 => ['Walking Dead'], ['American Horror Story'],
        7 => ['Walking Dead'], ['American Horror Story'],
    ];

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $i = 0;
        foreach (self::SEASONS as $number => $data) {
            $season = new Season();
            $season->setProgram ($title);
            $season->setNumber ($number);
            $season->setYear ();
            $i++;

            $manager->flush ();
        }
    }
}
