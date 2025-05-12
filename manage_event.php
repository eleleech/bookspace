<?php
require_once 'logic/event.php';
$event = new Event();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $event->addEvent($_POST['title'], $_POST['description'], $_POST['event_date'], $_POST['meeting_type_id'], $_POST['venue_id'], $_POST['participant_count']);
    } elseif (isset($_POST['update'])) {
        $event->updateEvent($_POST['id'], $_POST['title'], $_POST['description'], $_POST['event_date'], $_POST['meeting_type_id'], $_POST['venue_id'], $_POST['participant_count']);
    } elseif (isset($_POST['delete'])) {
        $event->deleteEvent($_POST['id']);
    }
}

$events = $event->getAllEvents();
$types = $event->getMeetingTypes();
$venues = $event->getVenues();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление мероприятиями</title>
    <style>
   <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #FEFAE0;
        padding: 30px;
    }
    h2 {
        text-align: center;
        color: #333;
    }
    form, table {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        margin: 20px auto;
        max-width: 1000px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input, select, textarea, button {
        margin: 5px;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    textarea {
        height: 60px;
        resize: vertical;
    }
    button {
        background-color: #C9CBA3;
        color: #333;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #b0b38d;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    table th, table td {
        padding: 10px;
        border: 1px solid #ccc;
    }
    table th {
        background-color: #C9CBA3;
        color: #333;
    }
    .action-form {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }
</style>


</head>
<body>

<a class="back-btn" href="i.html">← На главную</a>
<h2>Управление мероприятиями</h2>

<form method="POST">
    <input type="text" name="title" placeholder="Название мероприятия" required>
    <textarea name="description" placeholder="Описание мероприятия"></textarea>
    <input type="datetime-local" name="event_date" required>
    <select name="meeting_type_id" required>
        <?php foreach ($types as $t): ?>
            <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <select name="venue_id" required>
        <?php foreach ($venues as $v): ?>
            <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="number" name="participant_count" placeholder="Количество участников" min="0">
    <button name="add">Добавить мероприятие</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Дата</th>
        <th>Тип встречи</th>
        <th>Место</th>
        <th>Участники</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($events as $e): ?>
        <tr>
            <td><?= $e['id'] ?></td>
            <td><?= htmlspecialchars($e['title']) ?></td>
            <td><?= htmlspecialchars($e['description']) ?></td>
            <td><?= $e['event_date'] ?></td>
            <td><?= htmlspecialchars($e['meeting_type']) ?></td>
            <td><?= htmlspecialchars($e['venue_name']) ?></td>
            <td><?= $e['participant_count'] ?></td>
            <td>
                <form method="POST" class="action-form">
                    <input type="hidden" name="id" value="<?= $e['id'] ?>">
                    <input type="text" name="title" value="<?= htmlspecialchars($e['title']) ?>" required>
                    <textarea name="description"><?= htmlspecialchars($e['description']) ?></textarea>
                    <input type="datetime-local" name="event_date" value="<?= date('Y-m-d\TH:i', strtotime($e['event_date'])) ?>" required>
                    <select name="meeting_type_id">
                        <?php foreach ($types as $t): ?>
                            <option value="<?= $t['id'] ?>" <?= $t['id'] == $e['meeting_type_id'] ? 'selected' : '' ?>><?= htmlspecialchars($t['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="venue_id">
                        <?php foreach ($venues as $v): ?>
                            <option value="<?= $v['id'] ?>" <?= $v['id'] == $e['venue_id'] ? 'selected' : '' ?>><?= htmlspecialchars($v['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="participant_count" value="<?= $e['participant_count'] ?>">
                    <button name="update">Обновить</button>
                </form>
                <form method="POST" onsubmit="return confirm('Удалить мероприятие?')">
                    <input type="hidden" name="id" value="<?= $e['id'] ?>">
                    <button name="delete" style="background-color: #e74c3c;">Удалить</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
