<?php


namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $category = new Category();
        $category->setName ('Nom de la catégorie');
        $manager->persist ($category);
        $manager->flush();
    }
    const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];
}