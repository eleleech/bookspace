<?php
require_once 'db.bookspace/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];
    $card_id = $_POST['card_id'];

    // Создаем нового пользователя
    $user = new User();
    $user->addUser($last_name, $first_name, $middle_name, $email, $password, $role_id, $card_id);
    echo "Пользователь успешно добавлен!";
}
?>

<form method="POST" action="addUser.php">
    <label for="last_name">Фамилия:</label><br>
    <input type="text" name="last_name"><br><br>

    <label for="first_name">Имя:</label><br>
    <input type="text" name="first_name"><br><br>

    <label for="middle_name">Отчество:</label><br>
    <input type="text" name="middle_name"><br><br>

    <label for="email">Email:</label><br>
    <input type="email" name="email"><br><br>

    <label for="password">Пароль:</label><br>
    <input type="password" name="password"><br><br>

    <label for="role_id">Роль:</label><br>
    <input type="text" name="role_id"><br><br>

    <label for="card_id">Карта:</label><br>
    <input type="text" name="card_id"><br><br>

    <input type="submit" value="Добавить пользователя">
</form>
