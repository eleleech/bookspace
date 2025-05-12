<?php
require_once 'logic/event.php';  // Подключаем модель Event

// Создаем объект класса Event
$event = new Event();
$events = $event->getAllEvents();  // Получаем все мероприятия

echo "<h1>Список мероприятий</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Тип встречи</th>
            <th>Место</th>
            <th>Количество участников</th>
            <th>Изображение</th>
        </tr>";

// Выводим все мероприятия в таблице
foreach ($events as $e) {
    echo "<tr>
            <td>{$e['id']}</td>
            <td>{$e['event_date']}</td>
            <td>{$e['event_name']}</td>
            <td>{$e['description']}</td>
            <td>{$e['meeting_type']}</td>
            <td>{$e['venue']}</td>
            <td>{$e['participant_count']}</td>
            <td><img src='{$e['image']}' alt='Event Image' width='100'></td>
        </tr>";
}

echo "</table>";
?>
