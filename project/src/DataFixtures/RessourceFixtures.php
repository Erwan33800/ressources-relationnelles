<?php

namespace App\DataFixtures;

use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Ressource\Ressource;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RessourceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $ressource = new Ressource();
            $ressource->setTitle($faker->words(6, true))
                ->setAddress($faker->address())
                ->setDescription($faker->realText(200))
                ->setState($faker->randomElement(Ressource::STATES))
                ->setEventDate(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 year', '+1 year')))
                ->setNbLike(mt_rand(0, 100));
            $manager->persist($ressource);
        }

        $manager->flush();
    }
}
