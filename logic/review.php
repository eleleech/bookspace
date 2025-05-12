<?php
require_once __DIR__ . '/../db.php';

class Review {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAllReviews() {
        $stmt = $this->pdo->query("
            SELECT review.*, 
                   user.last_name, user.first_name, 
                   Book.title AS book_title
            FROM review
            JOIN user ON review.user_id = user.id
            JOIN Book ON review.book_id = Book.id
            ORDER BY publication_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT id, last_name, first_name FROM user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBooks() {
        $stmt = $this->pdo->query("SELECT id, title FROM Book");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addReview($user_id, $book_id, $text, $publication_date) {
        $stmt = $this->pdo->prepare("
            INSERT INTO review (user_id, book_id, text, publication_date) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$user_id, $book_id, $text, $publication_date]);
    }
	
	public function updateReview($id, $user_id, $book_id, $text, $publication_date) {
    $stmt = $this->pdo->prepare("
        UPDATE review 
        SET user_id = ?, book_id = ?, text = ?, publication_date = ? 
        WHERE id = ?
    ");
    $stmt->execute([$user_id, $book_id, $text, $publication_date, $id]);
}

	
    public function deleteReview($id) {
        $stmt = $this->pdo->prepare("DELETE FROM review WHERE id = ?");
        $stmt->execute([$id]);
    }
}
