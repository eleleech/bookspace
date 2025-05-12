<?php
require_once 'logic/user.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $user->addUser($_POST['lastname'], $_POST['firstname'], $_POST['patronymic'], $_POST['email'], $_POST['password'], $_POST['role']);
    } elseif (isset($_POST['update'])) {
        $user->updateUser($_POST['id'], $_POST['lastname'], $_POST['firstname'], $_POST['patronymic'], $_POST['email'], $_POST['password'], $_POST['role']);
    } elseif (isset($_POST['delete'])) {
        $user->deleteUser($_POST['id']);
    }
}

$users = $user->getAllUsers();
$roles = $user->getRoles();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление пользователями</title>
    <style>
    body {
    font-family: 'Arial', sans-serif;
    background: #FEFAE0; 
    padding: 30px;
	}

    h2 {
        color: #333;
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        background: #fff;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    th {
    background: #C9CBA3; 
    color: #333;
    }

    input, select, button {
        padding: 8px;
        margin: 5px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    button {
    background-color: #C9CBA3; /* было #3498db */
    color: #333; /* было white */
    border: none;
    cursor: pointer;
    padding: 10px 15px;
    border-radius: 5px;
}

   button:hover {
    background-color: #b0b38d; /* аналогично чуть темнее */
}

    .top-form {
        margin-bottom: 20px;
    }
</style>

</head>
<body>
    <h2>Управление пользователями</h2>

    <form class="top-form" method="POST">
        <input type="text" name="lastname" placeholder="Фамилия" required>
        <input type="text" name="firstname" placeholder="Имя" required>
        <input type="text" name="patronymic" placeholder="Отчество">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="password" placeholder="Пароль" required>
        <select name="role" required>
            <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button name="add">Добавить</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Email</th>
            <th>Пароль</th>
            <th>Роль</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($users as $u): ?>
            <tr>
                <form method="POST">
                    <td><?= $u['id'] ?><input type="hidden" name="id" value="<?= $u['id'] ?>"></td>
                    <td><input type="text" name="lastname" value="<?= htmlspecialchars($u['last_name']) ?>" required></td>
                    <td><input type="text" name="firstname" value="<?= htmlspecialchars($u['first_name']) ?>" required></td>
                    <td><input type="text" name="patronymic" value="<?= htmlspecialchars($u['middle_name']) ?>"></td>
                    <td><input type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" required></td>
                    <td><input type="text" name="password" value="<?= htmlspecialchars($u['password']) ?>" required></td>
                    <td>
                        <select name="role" required>
                            <?php foreach ($roles as $r): ?>
                                <option value="<?= $r['id'] ?>" <?= ($u['role_id'] == $r['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($r['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <button name="update">Обновить</button>
                        <button name="delete" onclick="return confirm('Удалить пользователя?')">Удалить</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="i.html">← На главную</a>
</body>
</html>
