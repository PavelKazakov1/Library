<?php

namespace App\Model;

class BookCategoryListResponse
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItem(): array
    {
        return $this->items;
    }
}