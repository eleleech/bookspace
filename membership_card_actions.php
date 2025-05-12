<?php
require_once __DIR__ . '/logic/membership_card.php';



// Обработка формы добавления карты
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = $_POST['payment_id'];
    $user_id = $_POST['user_id'];
    $status_id = $_POST['status_id'];
    $expiration_date = $_POST['expiration_date'];

    // Создаем объект класса MembershipCard
    $card = new MembershipCard();
    if ($card->addMembershipCard($payment_id, $user_id, $status_id, $expiration_date)) {
        $message = "Членская карта успешно добавлена!";
    } else {
        $message = "Ошибка при добавлении членской карты.";
    }
}

$card = new MembershipCard();
$cards = $card->getAllMembershipCards();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Членские карты</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
        }
        main {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="date"], select {
            padding: 8px;
            margin: 5px;
            width: 200px;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <header>
        <h1>Членские карты</h1>
    </header>

    <main>
        <?php if ($message): ?>
            <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
        <?php endif; ?>

        <h2>Добавить новую членскую карту</h2>
        <form method="POST">
            <label>Взнос ID: <input type="text" name="payment_id" required></label><br>
            <label>Пользователь ID: <input type="text" name="user_id" required></label><br>
            <label>Статус ID: <input type="text" name="status_id" required></label><br>
            <label>Дата окончания: <input type="date" name="expiration_date" required></label><br>
            <button type="submit">Добавить карту</button>
        </form>

        <h2>Список всех членских карт</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Взнос ID</th>
                <th>Пользователь ID</th>
                <th>Статус ID</th>
                <th>Дата окончания</th>
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
    </main>

</body>
</html>
