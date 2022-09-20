<?php

namespace Application\Model\UserLogin;

require_once ('src/Lib/DatabaseConnection.php');

class User
{
    private string $identifier;
    private string $fullName;
    private string $email;
    private string $password;


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

}
