<?php

namespace Core;

class Authenticator
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function attempt(string $email, string $password): bool
    {
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $email
        ])->fetch();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        $this->login($user);

        return true;
    }

    public function login(array $user): void
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
