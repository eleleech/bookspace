<?php
require_once 'logic/user.php';  // Подключаем модель User

$user = new User();
$users = $user->getAllUsers();

echo "<h1>Список пользователей</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Карты</th>
        </tr>";

foreach ($users as $u) {
    echo "<tr>
            <td>{$u['id']}</td>
            <td>{$u['last_name']}</td>
            <td>{$u['first_name']}</td>
            <td>{$u['email']}</td>
            <td>{$u['role_id']}</td>
            <td>{$u['card_id']}</td>
        </tr>";
}

echo "</table>";
