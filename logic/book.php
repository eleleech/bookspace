<?php
require_once __DIR__ . '/../db.php';

class Book {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAllBooks() {
        $stmt = $this->pdo->query("SELECT * FROM Book");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBook($title) {
        $stmt = $this->pdo->prepare("INSERT INTO Book (title) VALUES (?)");
        return $stmt->execute([$title]);
    }

    public function updateBook($id, $title) {
        $stmt = $this->pdo->prepare("UPDATE Book SET title = ? WHERE id = ?");
        return $stmt->execute([$title, $id]);
    }

    public function deleteBook($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Book WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
