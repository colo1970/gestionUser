<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Personne;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PersonneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $faker = Factory::create("fr_FR");
            $personne = new Personne();
            $personne
               ->setFirstname($faker->firstname)
               ->setName($faker->name)
               ->setAge($faker->numberBetween(18, 64))
               //->setJob()
               ;
               //ajouter $p1 à la trasaction
               $manager->persist($personne);
               //executer la transaction
               $manager->flush();
          }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
