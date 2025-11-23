<?php

namespace App\Models;

class Pass
{
    public function __construct(
        public ?int $id = null,
        public int $user_id,
        public string $purchase_date = '',
        public string $expiration_date = ''
    ) {}
}
