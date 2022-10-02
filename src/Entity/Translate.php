<?php

namespace App\Entity;

use App\Repository\TranslateRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: TranslateRepository::class)]
class Translate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Text::class)]
    private Text $text;

    #[ORM\ManyToOne(targetEntity: Language::class)]
    private Language $language;

    #[ORM\Column(type: 'text')]
    private string $translate;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeInterface $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): Text
    {
        return $this->text;
    }

    public function setText(Text $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getTranslate(): string
    {
        return $this->translate;
    }

    public function setTranslate(string $translate): self
    {
        $this->translate = $translate;
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
