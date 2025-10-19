<?php

namespace Core;

class Session
{
    /**
     * Store a value in the session.
     */
    public static function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieve a value from the session.
     * Flash values take priority.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    /**
     * Store a flash value (only available for the next request).
     */
    public static function flash(string $key, mixed $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    /**
     * Clear all flash messages. Should be called after reading flashes.
     */
    public static function unflash(): void
    {
        unset($_SESSION['_flash']);
    }

    /**
     * Completely destroy the session and remove cookies.
     */
    public static function destroy(): void
    {
        static::flush();

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }

        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    /**
     * Remove all session data.
     */
    public static function flush(): void
    {
        $_SESSION = [];
    }

    /**
     * Regenerate the session ID to prevent fixation attacks.
     */
    public static function regenerate(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    /**
     * Check if the current user is a guest (not logged in).
     */
    public static function isGuest(): bool
    {
        return !static::has('user');
    }

    /**
     * Check if a key exists in the session.
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Get the current logged-in user.
     */
    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Get and remove a flash value (useful for one-time messages).
     */
    public static function pull(string $key, mixed $default = null): mixed
    {
        if (isset($_SESSION['_flash'][$key])) {
            $value = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $value;
        }

        return $_SESSION[$key] ?? $default;
    }
}
