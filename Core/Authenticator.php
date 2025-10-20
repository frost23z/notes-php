<?php

namespace Core;

use Core\Repositories\UserRepository;
use Exception;

class Authenticator
{
    protected UserRepository $userRepo;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->userRepo = App::resolve(UserRepository::class);
    }

    public function attempt(string $email, string $password): bool
    {
        $user = $this->userRepo->findByEmail($email);

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
        Session::put('user', [
            'id' => $user['id'],
            'email' => $user['email']
        ]);

        Session::regenerate();
    }

    public function logout(): void
    {
        Session::destroy();
    }
}
