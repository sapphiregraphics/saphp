<?php

namespace App;

class Session {

    public function __construct() {
        $this->startSession();
    }

    private function startSession(): void {
        $timeout = 7200;
        ini_set('session.gc_maxlifetime', (string)$timeout);
        try {
            if (session_start() === false) {
                throw new \RuntimeException('Session could not be started.');
            }
        } catch (\RuntimeException $e) {
            // Handle the exception as needed
        }
    }

    public function get(string $key): mixed {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function set(string $key, mixed $value): self {
        // Add checks for valid session key here if needed
        $_SESSION[$key] = $value;
        return $this;
    }

    public function clear(): self {
        session_unset();
        return $this;
    }

    public function has(string $key): bool {
        // Add checks for valid session key here if needed
        return isset($_SESSION[$key]);
    }
}