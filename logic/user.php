<?php 
require_once __DIR__ . '/../db.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("
            SELECT user.*, role.name AS role 
            FROM user
            LEFT JOIN role ON user.role_id = role.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoles() {
        $stmt = $this->pdo->query("SELECT * FROM role");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser($lastname, $firstname, $patronymic, $email, $password, $roleId) {
        $stmt = $this->pdo->prepare("
            INSERT INTO user (last_name, first_name, middle_name, email, password, role_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$lastname, $firstname, $patronymic, $email, $password, $roleId]);
    }

    public function updateUser($id, $lastname, $firstname, $patronymic, $email, $password, $roleId) {
        $stmt = $this->pdo->prepare("
            UPDATE user
            SET last_name = ?, first_name = ?, middle_name = ?, email = ?, password = ?, role_id = ?
            WHERE id = ?
        ");
        $stmt->execute([$lastname, $firstname, $patronymic, $email, $password, $roleId, $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");
        $stmt->execute([$id]);
    }
}
