<?php

namespace Framework\Auth;

use Framework\Core\IIdentity;

class Account implements IIdentity
{
    private ?int $id = null;
    private string $role = 'customer';
    private string $first_name = '';
    private string $last_name = '';
    private string $email = '';
    private string $password = '';
    private float $credit = 0.0;

    public function __construct(string $email, string $password, string $first_name, string $last_name) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
    }

    /*
     * TODO : Implement full constructor
    public function __construct(int $id, string $first_name, string $last_name, string $email, string $password) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
    }
    */

    // ID
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    // Role
    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    // First Name
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    // Last Name
    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    // Email
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    // Password
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    // Credit
    public function getCredit(): float
    {
        return $this->credit;
    }

    public function setCredit(float $credit): void
    {
        $this->credit = $credit;
    }

    public function getName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }
}
