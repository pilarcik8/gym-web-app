<?php

namespace App\Models;

class Training
{
    public function __construct(
        public ?int $id = null,
        public int $customer_id,
        public int $trainer_id,
        public string $purchase_date = '',
        public string $start_date = ''
    ) {}
}
