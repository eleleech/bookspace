<?php
require_once '.../db.bookspace/db.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->connect();
    }

    // Получить все пользователей
    public function getAllUsers() {
        $stmt = $this->pdo->query('SELECT * FROM User');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Добавить пользователя
    public function addUser($last_name, $first_name, $middle_name, $email, $password, $role_id, $card_id) {
        $stmt = $this->pdo->prepare("INSERT INTO User (last_name, first_name, middle_name, email, password, role_id, card_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$last_name, $first_name, $middle_name, $email, $password, $role_id, $card_id]);
    }

    // Получить пользователя по ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM User WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
