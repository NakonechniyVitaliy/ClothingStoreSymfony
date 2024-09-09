<?php

namespace App\Entity;

use App\Repository\ClothRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity(repositoryClass: ClothRepository::class)]
class Cloth
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 1000)]
    private ?string $Description = null;

    #[ORM\ManyToOne(targetEntity: ClothCategory::class)]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private ClothCategory|null $category = null;

    public function getCategory(): ?ClothCategory
    {
        return $this->category;
    }

    public function setCategory(?ClothCategory $category): void
    {
        $this->category = $category;
    }

    #[ORM\Column]
    private ?int $Price = null;

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(?int $Price): void
    {
        $this->Price = $Price;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }
}
