<?php

namespace App\Models;

use Framework\Core\IIdentity;

class GroupClass implements IIdentity
{
    public function __construct(
        public ?int $id = null,
        public string $name = '',
        public string $date = '',
        public int $duration_minutes = 0,
        public int $trainer_id = 0
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getDurationMinutes(): int
    {
        return $this->duration_minutes;
    }

    public function setDurationMinutes(int $duration_minutes): void
    {
        $this->duration_minutes = $duration_minutes;
    }

    public function getTrainerId(): int
    {
        return $this->trainer_id;
    }

    public function setTrainerId(int $trainer_id): void
    {
        $this->trainer_id = $trainer_id;
    }
}
