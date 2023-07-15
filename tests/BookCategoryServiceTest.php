<?php

namespace App\Tests\Service;

use App\Entity\BookCategory;
use App\Model\BookCategoryListItem;
use App\Model\BookCategoryListResponse;
use App\Repository\BookCategoryRepository;
use App\Service\BookCategoryService;
use App\Tests\Controller\AbstractTestCase;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;

class BookCategoryServiceTest extends AbstractTestCase
{

    public function testGetCategories(): void
    {
        $category = (new BookCategory())->setTitle('Test');
        $this->setEntityId($category,7);
        $repository = $this->createMock(BookCategoryRepository::class);
        $repository->expects($this->once())->
        method('findBy')
        ->with([],['title'=>Criteria::ASC])
        ->willReturn((new BookCategory())->setTitle('Test'));

        $service = new BookCategoryService($repository); 
        $expected = new BookCategoryListResponse([new BookCategoryListItem(7,'Test')]);
        $this->assertEquals($expected,  $service->getCategories());
       
    }
    //$service = new BookCategory($repositoty); 
}