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
        'Andrew Lincoln'=> ['Walking Dead' ], ['Fear The Walking Dead'],
        'Norman Reedus'=> ['Walking Dead'],
        'Lauren Cohan'=> ['Walking Dead'],
         'Danai Gurira'=> ['Walking Dead'],

    ];
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::ACTORS as $name=>$programs) {
            $actor = new Actor();
            $actor->setName ($name);
            foreach ($programs as $program){
                $actor->addProgram($this->getReference($program));
            }
        }
        $manager->flush();
    }
    public function getDependencies()

    {

        return [ProgramFixtures::class];

    }



}
/**
 * This method must return an array of fixtures classes
 * on which the implementing class depends on
 *
 * @return array
 */public function getDependencies()
{
    // TODO: Implement getDependencies() method.
}/**
 * Load data fixtures with the passed EntityManager
 */public function load(ObjectManager $manager)
{
    // TODO: Implement load() method.
}/**
 * This method must return an array of fixtures classes
 * on which the implementing class depends on
 *
 * @return array
 */public function getDependencies()
{
    // TODO: Implement getDependencies() method.
}/**
 * Load data fixtures with the passed EntityManager
 */public function load(ObjectManager $manager)
{
    // TODO: Implement load() method.
}/**
 * This method must return an array of fixtures classes
 * on which the implementing class depends on
 *
 * @return array
 */public function getDependencies()
{
    // TODO: Implement getDependencies() method.
}/**
 * Load data fixtures with the passed EntityManager
 */public function load(ObjectManager $manager)
{
    // TODO: Implement load() method.
}