<?php
require_once __DIR__ . '/logic/user.php';

$userLogic = new User();
$message = "";

// Добавление пользователя
if (isset($_POST['add_user'])) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля
    $role_name = $_POST['role_name'];  // Роль пользователя
    $card_id = $_POST['card_id'];

    if ($userLogic->addUser($last_name, $first_name, $middle_name, $email, $password, $role_name, $card_id)) {
        $message = "Пользователь успешно добавлен!";
    } else {
        $message = "Ошибка при добавлении пользователя.";
    }
}

// Получение всех пользователей
$users = $userLogic->getAllUsers();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление пользователями</title>
</head>
<body>
    <h1>Управление пользователями</h1>

    <?php if ($message): ?>
        <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
    <?php endif; ?>

    <h2>Добавить пользователя</h2>
    <form method="POST">
        <input type="text" name="last_name" placeholder="Фамилия" required><br>
        <input type="text" name="first_name" placeholder="Имя" required><br>
        <input type="text" name="middle_name" placeholder="Отчество" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>

        <!-- Выбор роли -->
        <select name="role_name" required>
            <option value="Администратор">Администратор</option>
            <option value="Пользователь">Пользователь</option>
        </select><br>

        <input type="number" name="card_id" placeholder="ID карты" required><br>
        <input type="submit" name="add_user" value="Добавить пользователя">
    </form>

    <h2>Список пользователей</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Фамилия</th><th>Имя</th><th>Email</th><th>Роль</th><th>Карта</th>
        </tr>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['id']) ?></td>
                <td><?= htmlspecialchars($u['last_name']) ?></td>
                <td><?= htmlspecialchars($u['first_name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['role_name']) ?></td> <!-- Выводим роль -->
                <td><?= htmlspecialchars($u['card_id']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
