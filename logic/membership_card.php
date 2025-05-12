<?php
require_once __DIR__ . '/../db.php';


class MembershipCard {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();

    }

    // Получить все членские карты
    public function getAllMembershipCards() {
        $stmt = $this->pdo->query('SELECT * FROM MembershipCard');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Добавить членскую карту
    public function addMembershipCard($payment_id, $user_id, $status_id, $expiration_date) {
        $stmt = $this->pdo->prepare("INSERT INTO MembershipCard (payment_id, user_id, status_id, expiration_date) 
                                    VALUES (?, ?, ?, ?)");
        return $stmt->execute([$payment_id, $user_id, $status_id, $expiration_date]);
    }
}
?>
