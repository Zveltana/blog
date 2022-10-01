<?php

namespace Application\Model\Repository;

use Application\Lib\DatabaseConnection;
use Application\Model\User;

class UsersRepository
{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function getUsers(): array {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM users"
        );

        $users = [];
        while (($row = $statement->fetch())){
            $user = new User();
            $user->setFullName($row['full_name']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setIdentifier($row['id']);
            $user->setIsAdmin($row['is_admin']);

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
        $user->setIdentifier($row['id']);
        $user->setFullName($row['full_name']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setIsAdmin($row['is_admin']);

        return $user;
    }

    public function getUserById(int $id): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM users WHERE id = :id"
        );

        $statement->execute(['id' => $id]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $user = new User();
        $user->setIdentifier($row['id']);
        $user->setFullName($row['full_name']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setIsAdmin($row['is_admin']);

        return $user;
    }

    public function createUser (User $user): bool {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO users(full_name, email, password) VALUES(:fullName, :email, :password)"
        );

        $statement->execute([
            'fullName' => $user->getFullName(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT)
        ]);

        return true;
    }

    public function updateUser (User $user): void {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE users SET is_admin = :is_admin WHERE id = :id"
        );

        $statement->execute([
            'id' => $user->getIdentifier(),
            'is_admin' => $user->getIsAdmin(),
        ]);
    }

}
