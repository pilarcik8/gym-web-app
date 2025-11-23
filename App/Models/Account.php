<?php

namespace App\Models;

use Framework\Core\IIdentity;

class Account implements IIdentity
{
    public function __construct(
        public ?int $id = null,
        public string $role = '',
        public string $first_name = '',
        public string $last_name = '',
        public string $email = '',
        public string $password = '',
        public float $credit = 0.0
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }
}

