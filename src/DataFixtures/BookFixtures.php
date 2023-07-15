<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\BookCategory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{

    
    public function load(ObjectManager $manager): void
    {
        $dramaCategory = $this->getReference(BookCategoryFixtures::DRAMA_CATEGORY);
        $horrorCategory = $this->getReference(BookCategoryFixtures::HORROR_CATEGORY);

        $book = (new Book())
        ->setTitle('Looking for Alaska')
        ->setPublicationDate(new DateTime('2019-01-04'))
        ->setMeap(false)
        ->setAuthors(['Johny Depp'])
        ->setCategories(new ArrayCollection([$dramaCategory]))
        ->setImage('https://images.squarespace-cdn.com/content/55db3b44e4b01e5be14cad77/1468945644380-K5POLDSJY1G0ER08FZ5A/?format=1000w&content-type=image%2Fjpeg');

        $manager->persist($book);
        $manager->flush();
    }

    public function getDependencies():array
    {
        return [
            BookCategoryFixtures::class
        ];
    }
}