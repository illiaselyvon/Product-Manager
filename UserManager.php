<?php

require_once 'User.php';

class UserManager {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register(User $user): bool {
        if ($this->userExists($user->getUsername())) {
            return false;
        }

        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $this->pdo->prepare($sql);

        $result = $stmt->execute([
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword()
        ]);

        if ($result) {
            $userId = $this->pdo->lastInsertId();
            $user->setId((int)$userId);

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
        }

        return $result;
    }

    public function userExists(string $username): bool {
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetch() !== false;
    }

    public function login(string $username, string $password): bool {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data && password_verify($password, $data['password'])) {
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            return true;
        }

        return false;
    }

    public function logout(): void {
        session_destroy();
        $_SESSION = [];
    }

    public function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUser(): ?User {
        if (!$this->isLoggedIn()) return null;

        return new User(
            $_SESSION['username'],
            '',
            $_SESSION['user_id']
        );
    }
}
