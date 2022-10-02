<?php

namespace App\Model;

use DateTimeInterface;

class ProjectListItem
{
    private int $id;

    private string $title;

    private DateTimeInterface $createdAt;

    public function __construct(int $id, string $title, DateTimeInterface $createdAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
