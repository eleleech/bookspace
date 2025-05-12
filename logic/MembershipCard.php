<?php
require_once 'db.php';

class MembershipCard {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->connect();
    }

    // Получить все членские карты
    public function getAllMembershipCards() {
        $stmt = $this->pdo->query('SELECT * FROM MembershipCard');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Добавить членскую карту
    public function addMembershipCard($payment_id, $user_id, $status_id, $expiration_date) {
        $stmt = $this->pdo->prepare("INSERT INTO MembershipCard (payment_id, user_id, status_id, expiration_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$payment_id, $user_id, $status_id, $expiration_date]);
    }

    // Получить членскую карту по ID
    public function getMembershipCardById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM MembershipCard WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
