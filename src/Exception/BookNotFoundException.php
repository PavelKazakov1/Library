<?php 

namespace App\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class BookNotFoundException extends RuntimeException{
    public function __construct()
    {
        parent::__construct("book not found", Response::HTTP_NOT_FOUND);
    }
}