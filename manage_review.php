<?php
require_once 'logic/review.php';
require_once 'logic/user.php';
require_once 'logic/book.php';

$review = new Review();
$user = new User();
$book = new Book();

// Получаем все рецензии
$reviews = $review->getAllReviews();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление рецензиями</title>
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
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: #fff;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }
    th {
        background: #C9CBA3;
        color: #333;
    }
    button {
        background-color: #C9CBA3;
        color: #333;
        border: none;
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 5px;
    }
    button:hover {
        background-color: #b0b38d;
    }
    .actions {
        display: flex;
        justify-content: space-around;
    }
</style>
</head>
<body>

<h2>Управление рецензиями</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Пользователь</th>
        <th>Книга</th>
        <th>Текст</th>
        <th>Дата</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($reviews as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['first_name'] . ' ' . $r['last_name'] ?? 'Неизвестно') ?></td>
            <td><?= htmlspecialchars($r['book_title'] ?? 'Неизвестно') ?></td>
            <td><?= nl2br(htmlspecialchars($r['text'] ?? '')) ?></td>
            <td><?= $r['publication_date'] ?></td>
            <td class="actions">
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $r['id'] ?>">
                    <button name="delete" onclick="return confirm('Удалить рецензию?')">Удалить</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="i.html">На главную</a>

</body>
</html>
