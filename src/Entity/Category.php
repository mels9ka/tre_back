<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Project::class)]
    private Project $project;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    private ?Category $parentCategory;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $title;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->parentCategory = null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function setProject(Project $project): self
    {
        $this->project = $project;
        return $this;
    }

    public function getParentCategory(): ?Category
    {
        return $this->parentCategory;
    }

    public function setParentCategory(?Category $parentCategory): self
    {
        $this->parentCategory = $parentCategory;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new DateTimeImmutable();
    }

    #[ORM\PrePersist]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
