<?php
require_once __DIR__ . '/../db.php';

class Event {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAllEvents() {
        $stmt = $this->pdo->query("SELECT event.*, MeetingType.name AS meeting_type, venue.name AS venue_name
                                   FROM event
                                   LEFT JOIN MeetingType ON event.meeting_type_id = MeetingType.id
                                   LEFT JOIN venue ON event.venue_id = venue.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMeetingTypes() {
        return $this->pdo->query("SELECT * FROM MeetingType")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVenues() {
        return $this->pdo->query("SELECT * FROM venue")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addEvent($title, $description, $date, $meeting_type_id, $venue_id, $count) {
        $stmt = $this->pdo->prepare("INSERT INTO event (title, description, event_date, meeting_type_id, venue_id, participant_count) 
                                     VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $date, $meeting_type_id, $venue_id, $count]);
    }

    public function updateEvent($id, $title, $description, $date, $meeting_type_id, $venue_id, $count) {
        $stmt = $this->pdo->prepare("UPDATE event 
                                     SET title=?, description=?, event_date=?, meeting_type_id=?, venue_id=?, participant_count=?
                                     WHERE id=?");
        $stmt->execute([$title, $description, $date, $meeting_type_id, $venue_id, $count, $id]);
    }

    public function deleteEvent($id) {
        $stmt = $this->pdo->prepare("DELETE FROM event WHERE id = ?");
        $stmt->execute([$id]);
    }
}
