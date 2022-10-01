<?php

namespace Application\Model;

class User
{
    private string $identifier;
    private string $fullName;
    private string $email;
    private string $password;
    private bool $isAdmin;

    public function getIdentifier(): string
    {
        return $this->identifier;
    }


    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }


    public function getFullName(): string
    {
        return $this->fullName;
    }


    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function getPassword(): string
    {
        return $this->password;

    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

}
