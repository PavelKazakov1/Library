<?php

namespace App\Service;

use App\Exception\BookCategoryNotFoundException;
use App\Model\BookDetails;
use App\Model\BookFormat;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Repository\BookCategoryRepository;
use App\Repository\BookRepository;
use App\Repository\ReviewRepository;
use App\Entity\Book;
use App\Entity\BookToBookFormat;
use App\Model\BookCategory as BookCategoryModel;
use App\Entity\BookCategory;
use PhpParser\ErrorHandler\Collecting;
use Doctrine\Common\Collections\Collection;

class BookService{
    public function __construct(private BookRepository $bookRepository, private BookCategoryRepository $bookCategoryRepository, private ReviewRepository $reviewRepository){

    }

    public function getBooksByCategory(int $categoryId): BookListResponse
    {
        $category = $this->bookCategoryRepository->find($categoryId);
        if(null === $category){
            throw new BookCategoryNotFoundException();
        }

        return new BookListResponse(array_map(
            [$this,'map'],
            $this->bookRepository->findBooksByCategoryId($categoryId)
        ));
    }


    public function getBookById(int $id): BookDetails
    {   
        $book = $this->bookRepository->getById($id);

        $categories = $book->getCategories()->map(
            function (BookCategory $bookCategory) {
                return new BookCategoryModel(
                    $bookCategory->getId(),
                    $bookCategory->getTitle()
                );
            }
        );

        $formats = $this->mapFormats($book->getFormats());

        return (new BookDetails())
            ->setId($book->getId())
            ->setTitle($book->getTitle())
            ->setimage($book->getImage())
            ->setAuthors($book->getAuthors())
            ->setPublicationDate($book->getPublicationDate()->getTimestamp())
            ->setFormats($formats)
            ->setCategories($categories->toArray());
    }



    private function mapFormats(Collection $formats): array
    {
        return $formats->map(
            function (BookToBookFormat $formatJoin) {
                return (new BookFormat())
                    ->setId($formatJoin->getFormat()->getId())
                    ->setTitle($formatJoin->getFormat()->getTitle())
                    ->setDescription($formatJoin->getFormat()->getDescription())
                    ->setComment($formatJoin->getFormat()->getComment())
                    ->setPrice($formatJoin->getPrice())
                    ->setDiscountPercent($formatJoin->getDiscountPercent());
            }
        )->toArray();
    }
    

    private function map(Book $book): BookListItem{
        return (new BookListItem())
        ->setID($book->getId())
        ->setTitle($book->getTitle())
        ->setimage($book->getImage())
        ->setAuthors($book->getAuthors())
        ->setPublicationDate($book->getPublicationDate()->getTimestamp());
        
        
    }
}