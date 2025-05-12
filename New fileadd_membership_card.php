<?php
require_once 'logic/MembershipCard.php';
require_once 'logic/User.php';

// Логика добавления карты
$membershipCardLogic = new MembershipCard();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = $_POST['payment_id'];
    $user_id = $_POST['user_id'];
    $status_id = $_POST['status_id'];
    $expiration_date = $_POST['expiration_date'];

    if ($membershipCardLogic->addMembershipCard($payment_id, $user_id, $status_id, $expiration_date)) {
        $message = "Членская карта успешно добавлена!";
    } else {
        $message = "Ошибка при добавлении членской карты.";
    }
}

// Получение всех карт
$cards = $membershipCardLogic->getAllMembershipCards();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление членскими картами</title>
</head>
<body>
    <h1>Управление членскими картами</h1>

    <?php if ($message): ?>
        <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
    <?php endif; ?>

    <h2>Добавить новую карту</h2>
    <form method="POST">
        <label>Payment ID: <input type="text" name="payment_id" required></label><br>
        <label>User ID: <input type="number" name="user_id" required></label><br>
        <label>Status ID: <input type="number" name="status_id" required></label><br>
        <label>Expiration Date: <input type="date" name="expiration_date" required></label><br>
        <button type="submit">Добавить карту</button>
    </form>

    <h2>Список членских карт</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Payment ID</th>
            <th>User ID</th>
            <th>Status ID</th>
            <th>Expiration Date</th>
        </tr>
        <?php foreach ($cards as $card): ?>
            <tr>
                <td><?php echo htmlspecialchars($card['id']); ?></td>
                <td><?php echo htmlspecialchars($card['payment_id']); ?></td>
                <td><?php echo htmlspecialchars($card['user_id']); ?></td>
                <td><?php echo htmlspecialchars($card['status_id']); ?></td>
                <td><?php echo htmlspecialchars($card['expiration_date']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="index.php">Вернуться на главную страницу</a>
</body>
</html>
