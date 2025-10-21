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
            'SELECT * FROM notes WHERE user_id = :user_id ORDER BY updated_at DESC, id DESC',
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
        // Auto-generate title if empty or null
        if (empty($title)) {
            $title = $this->generateTitle($content);
        }

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

    /**
     * Generate title from content (first 50 chars, clean)
     */
    private function generateTitle(string $content): string
    {
        // Remove extra whitespace and newlines
        $clean = trim(preg_replace('/\s+/', ' ', $content));

        // Take first 50 characters
        $title = mb_substr($clean, 0, 50);

        // If we cut mid-word, try to end at last complete word
        if (mb_strlen($clean) > 50) {
            $lastSpace = mb_strrpos($title, ' ');
            if ($lastSpace !== false && $lastSpace > 20) {
                $title = mb_substr($title, 0, $lastSpace);
            }
            $title .= '...';
        }

        return $title ?: 'Untitled Note';
    }

    public function update(int $id, string $title, string $content): void
    {
        // Auto-generate title if empty or null
        if (empty($title)) {
            $title = $this->generateTitle($content);
        }

        $this->db->query(
            'UPDATE notes SET title = :title, content = :content WHERE id = :id',
            [
                'title' => $title,
                'content' => $content,
                'id' => $id
            ]
        );
    }

    /**
     * Update only the title of a note
     */
    public function updateTitle(int $id, string $title): void
    {
        $this->db->query(
            'UPDATE notes SET title = :title WHERE id = :id',
            [
                'title' => $title,
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
