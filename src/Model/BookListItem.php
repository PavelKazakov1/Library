<?php

namespace App\Model;

class BookListItem
{
    private int $id;
    private string $title;
    private string $image;

    /**
     * @var string[]
     */
    private array $authors;
    private bool $meap;

    private int $publicationDate;

   

	

	
	public function getId(): int {
		return $this->id;
	}


	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}


	public function getTitle(): string {
		return $this->title;
	}
	
	
	public function setTitle(string $title): self {
		$this->title = $title;
		return $this;
	}


	public function getImage(): string {
		return $this->image;
	}
	
	
	public function setImage(string $image): self {
		$this->image = $image;
		return $this;
	}

	
	public function getAuthors(): array {
		return $this->authors;
	}
	
	/**
	 * 
	 * @param string[] $authors 
	 * @return self
	 */
	public function setAuthors(array $authors): self {
		$this->authors = $authors;
		return $this;
	}

	public function getMeap(): bool {
		return $this->meap;
	}
	

	public function setMeap(bool $meap): self {
		$this->meap = $meap;
		return $this;
	}

	public function getPublicationDate(): int {
		return $this->publicationDate;
	}
	
	public function setPublicationDate(int $publicationDate): self {
		$this->publicationDate = $publicationDate;
		return $this;
	}
}