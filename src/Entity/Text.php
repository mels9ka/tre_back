<?php

namespace App\Entity;

use App\Repository\TextRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: TextRepository::class)]
class Text
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    private Category $category;

    /**
     * @var Collection<Translate>
     */
    #[ORM\OneToMany(mappedBy: 'text', targetEntity: Translate::class)]
    private Collection $translates;

    #[ORM\Column(type: 'string')]
    private string $key;

    #[ORM\Column(type: 'text')]
    private string $defaultText;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->translates = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Collection<Translate>
     */
    public function getTranslates(): Collection
    {
        return $this->translates;
    }

    /**
     * @param Collection<Translate> $translates
     * @return $this
     */
    public function setTranslates(Collection $translates): self
    {
        $this->translates = $translates;
        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    public function getDefaultText(): string
    {
        return $this->defaultText;
    }

    public function setDefaultText(string $defaultText): self
    {
        $this->defaultText = $defaultText;
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
