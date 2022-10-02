<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    /**
     * @var Collection<Language>
     */
    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: Project::class)]
    private Collection $languages;

    #[ORM\Column(type: 'string')]
    private string $slug;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $title;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface $createdAt;

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    /**
     * @param Collection $languages
     * @return Project
     */
    public function setLanguages(Collection $languages): self
    {
        $this->languages = $languages;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
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
}
