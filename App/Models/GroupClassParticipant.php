<?php

namespace App\Models;

class GroupClassParticipant
{
    public function __construct(
        public int $customer_id,
        public int $group_class_id,
        public string $customer_note = ''
    ) {}

    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function getGroupClassId(): int
    {
        return $this->group_class_id;
    }

    public function setGroupClassId(int $group_class_id): void
    {
        $this->group_class_id = $group_class_id;
    }

    public function getCustomerNote(): string
    {
        return $this->customer_note;
    }

    public function setCustomerNote(string $customer_note): void
    {
        $this->customer_note = $customer_note;
    }
}
