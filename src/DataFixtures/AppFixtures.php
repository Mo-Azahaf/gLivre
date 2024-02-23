<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $editors = [];

        for ($i = 0; $i < 10; $i++) {

            $editors[$i] = new Editor();
            $editors[$i]->setName($faker->company());
            $editors[$i]->setAdresse($faker->address());

            $manager->persist($editors[$i]);
        }
        $authers = [];
        for ($i = 0; $i < 20; $i++) {
            $authers[$i] = new Author();
            $authers[$i]->setName($faker->lastName());
            $authers[$i]->setLastname($faker->firstName());

            $manager->persist($authers[$i]);
        }
        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book->setEditor($editors[array_rand($editors)]);
            $book->setAuthor($authers[array_rand($authers)]);
            $book->setTitle($faker->words(3, true));
            $book->setIsbn($faker->isbn13());
            $book->setDescription($faker->sentences(2, true));
            $book->setResume($faker->sentence());
            $book->setPrice($faker->randomFloat(2, 1, 9999));
            $manager->persist($book);
        }



        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
