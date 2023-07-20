<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\BookCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function countByBookId(int $id): int
    {
        return $this->count(['book' => $id]);
    }

    public function getBookTotalRatingSum(int $id): ?int
    {
        return (int)$this->_em->createQuery('SELECT SUM(r.rating) from App\Entity\Review r where r.book = :id')
        ->setParameter('id', $id)
        ->getSingleScalarResult();
    }

}