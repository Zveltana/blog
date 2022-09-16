<?php

namespace Application\Model\Login;

use Application\lib\Database\DatabaseConnection;
use Application\Model\Post\Post;

require_once ('src/Lib/DatabaseConnection.php');

class Login
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

class UsersRepository {
    public DatabaseConnection $connection;

    public function getUsers(): array {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, full_name, password, email FROM users"
        );

        $users = [];
        while (($row = $statement->fetch())){
            $user = new Login();
            $user -> setFullName($row['full_name']);
            $user -> setEmail($row['email']);
            $user -> setPassword($row['password']);
            $user -> setIdentifier($row['id']);

            $users[] = $user;
        }

        return $users;
    }

    public function getUser(string $email): ?Login
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, full_name, email, password FROM users WHERE email = :email"
        );
        $statement->execute(['email'=>$email]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $user = new Login();
        $user -> setIdentifier($row['id']);
        $user -> setFullName($row['full_name']);
        $user -> setEmail($row['email']);
        $user -> setPassword($row['password']);

        return $user;
    }

    public function createUser (string $full_name, string $email, string $password): bool {
        $statement = $this->connection->getConnection()->prepare("
        INSERT INTO users(id, full_name, email, password) VALUES(?, ?, ?, ?)
        ");

        $affectedLines = $statement->execute([$full_name, $email, $password]);

        return ($affectedLines > 0);
    }
}
