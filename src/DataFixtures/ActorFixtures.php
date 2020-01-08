<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program;
use App\Service\Slugify;
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

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('us_US');
        for ($i = 1; $i < 7; $i++) {
            for ($j = 1; $j < 10; $j++) {
                $actor = new Actor();
                $actor->setName ($faker->name());

                $actor->addProgram ($this->getReference ('program' . $i));
                $slug = $this->slugify->generate($actor->getName());
                $actor->setSlug($slug);

                $manager->persist ($actor);
            }
        }
        $manager->flush ();
    }
    public function getDependencies()

    {

        return [ProgramFixtures::class];

    }

}
