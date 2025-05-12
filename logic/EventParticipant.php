<?php
require_once 'db.php';

class EventParticipant {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->connect();
    }

    // Получить всех участников мероприятия
    public function getAllParticipants() {
        $stmt = $this->pdo->query('SELECT * FROM EventParticipant');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Добавить участника в мероприятие
    public function addParticipant($user_id, $event_id, $registration_date) {
        $stmt = $this->pdo->prepare("INSERT INTO EventParticipant (user_id, event_id, registration_date) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $event_id, $registration_date]);
    }

    // Получить участника мероприятия по ID
    public function getParticipantById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM EventParticipant WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
