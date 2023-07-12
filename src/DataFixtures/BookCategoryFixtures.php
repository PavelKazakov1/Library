<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
         $manager->persist((new BookCategory())->setTitle('Horror'));
         $manager->persist((new BookCategory())->setTitle('Comedy'));
         $manager->persist((new BookCategory())->setTitle('Poetry'));

        $manager->flush();
    }
}
