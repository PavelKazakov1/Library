<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture
{
    public const DRAMA_CATEGORY = 'drama';
    public const HORROR_CATEGORY = 'horror';
    
    
    public function load(ObjectManager $manager): void
    {
        $categories = [
            self::DRAMA_CATEGORY => (new BookCategory())->setTitle('Drama'),
            self::HORROR_CATEGORY => (new BookCategory())->setTitle('Horror')
        ];

        foreach($categories as $category){
            $manager->persist($category);
        }
        // $product = new Product();

         $manager->persist((new BookCategory())->setTitle('Poetry'));

        $manager->flush();

        foreach($categories as $code => $categories){
            $this->addReference($code, $categories);
        }
    }
}
