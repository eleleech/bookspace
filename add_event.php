<?php
require_once __DIR__ . '/logic/event.php';

$event = new Event();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = $_POST['event_date'] ?? '';
    $event_name = $_POST['event_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $meeting_type = $_POST['meeting_type'] ?? '';
    $venue = $_POST['venue'] ?? '';
    $participant_count = $_POST['participant_count'] ?? 0;

    if ($event->addEvent($event_date, $event_name, $description, $meeting_type, $venue, $participant_count)) {
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $message = "Ошибка при добавлении мероприятия.";
    }
}

$events = $event->getAllEvents();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление мероприятиями</title>
</head>
<body>
	 <a href="i.html" style="display: inline-block; margin-bottom: 20px; padding: 8px 16px; background-color: #606c38; color: white; text-decoration: none; border-radius: 4px;">⟵ На главную</a>
    <h1>Управление мероприятиями</h1>

    <?php if (!empty($message)): ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>

    <h2>Добавить мероприятие</h2>
    <form method="POST">
        <label>Дата: <input type="datetime-local" name="event_date" required></label><br>
        <label>Название: <input type="text" name="event_name" required></label><br>
        <label>Описание: <textarea name="description" required></textarea></label><br>
        <label>Тип встречи: <input type="text" name="meeting_type" required></label><br>
        <label>Место проведения: <input type="text" name="venue" required></label><br>
        <label>Количество участников: <input type="number" name="participant_count" required></label><br>
        <button type="submit">Добавить</button>
    </form>

    <h2>Список мероприятий</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Тип встречи</th>
            <th>Место</th>
            <th>Участники</th>
        </tr>
        <?php foreach ($events as $e): ?>
            <tr>
                <td><?= htmlspecialchars($e['id'] ?? '') ?></td>
                <td><?= htmlspecialchars($e['event_date'] ?? '') ?></td>
                <td><?= htmlspecialchars($e['event_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($e['description'] ?? '') ?></td>
                <td><?= htmlspecialchars($e['meeting_type'] ?? '') ?></td>
                <td><?= htmlspecialchars($e['venue'] ?? '') ?></td>
                <td><?= htmlspecialchars($e['participant_count'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
