<?php

namespace Core\Repositories;

use Core\App;
use Core\Database;
use Exception;

class UserRepository
{
    protected Database $db;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    /**
     * Find a user by ID.
     */
    public function findById(int $id): array|false
    {
        return $this->db->query(
            'SELECT * FROM users WHERE id = :id',
            ['id' => $id]
        )->fetch();
    }

    /**
     * Create a new user.
     */
    public function create(string $email, string $hashedPassword): int
    {
        $this->db->query(
            'INSERT INTO users (email, password) VALUES (:email, :password)',
            [
                'email' => $email,
                'password' => $hashedPassword
            ]
        );

        return $this->db->lastInsertId();
    }

    /**
     * Check if a user exists with the given email.
     */
    public function existsByEmail(string $email): bool
    {
        $user = $this->findByEmail($email);
        return $user !== false;
    }

    /**
     * Find a user by email address.
     */
    public function findByEmail(string $email): array|false
    {
        return $this->db->query(
            'SELECT * FROM users WHERE email = :email',
            ['email' => $email]
        )->fetch();
    }
}
