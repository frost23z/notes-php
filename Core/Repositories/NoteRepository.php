<?php

namespace Core\Repositories;

use Core\App;
use Core\Database;
use Exception;

class NoteRepository
{
    protected Database $db;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function findAll(int $userId): array
    {
        return $this->db->query(
            'SELECT * FROM notes WHERE user_id = :user_id ORDER BY id DESC',
            ['user_id' => $userId]
        )->fetchAll();
    }

    public function findById(int $id): array
    {
        return $this->db->query(
            'SELECT * FROM notes WHERE id = :id',
            ['id' => $id]
        )->fetchOrFail();
    }

    public function create(string $title, string $content, int $userId): int
    {
        $this->db->query(
            'INSERT INTO notes (title, content, user_id) VALUES (:title, :content, :user_id)',
            [
                'title' => $title,
                'content' => $content,
                'user_id' => $userId
            ]
        );

        return $this->db->lastInsertId();
    }

    public function update(int $id, string $title, string $content): void
    {
        $this->db->query(
            'UPDATE notes SET title = :title, content = :content WHERE id = :id',
            [
                'title' => $title,
                'content' => $content,
                'id' => $id
            ]
        );
    }

    public function delete(int $id): void
    {
        $this->db->query(
            'DELETE FROM notes WHERE id = :id',
            ['id' => $id]
        );
    }

    public function belongsToUser(array $note, int $userId): bool
    {
        return $note['user_id'] === $userId;
    }
}
