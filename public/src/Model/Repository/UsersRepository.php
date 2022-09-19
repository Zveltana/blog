<?php

namespace Application\Model\Repository\Users;

use Application\lib\Database\DatabaseConnection;
use Application\Model\UserLogin\User;

class UsersRepository {
    public DatabaseConnection $connection;

    public function getUsers(): array {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, full_name, password, email FROM users"
        );

        $users = [];
        while (($row = $statement->fetch())){
            $user = new User();
            $user -> setFullName($row['full_name']);
            $user -> setEmail($row['email']);
            $user -> setPassword($row['password']);
            $user -> setIdentifier($row['id']);

            $users[] = $user;
        }

        return $users;
    }

    public function getUserByEmail(string $email): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM users WHERE email = :email"
        );

        $statement->execute(['email'=>$email]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $user = new User();
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
