<?php
require_once 'db.php';
require_once 'logic/review.php';  // Правильный путь

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $publication_date = $_POST['publication_date'];

    // Создаем объект класса Review
    $review = new Review();
    if ($review->addReview($user_id, $book_id, $title, $text, $publication_date)) {
        $message = "Рецензия успешно добавлена!";
    } else {
        $message = "Ошибка при добавлении рецензии.";
    }
}

// Получаем все рецензии
$review = new Review();
$reviews = $review->getAllReviews();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление и просмотр рецензий</title>
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
        input[type="text"], input[type="date"], textarea {
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
        <h1>Рецензии</h1>
    </header>

    <main>
        <?php if ($message): ?>
            <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
        <?php endif; ?>

        <h2>Добавить рецензию</h2>
        <form method="POST">
            <label>Пользователь ID: <input type="text" name="user_id" required></label><br>
            <label>Книга ID: <input type="text" name="book_id" required></label><br>
            <label>Заголовок: <input type="text" name="title" required></label><br>
            <label>Текст рецензии: <textarea name="text" required></textarea></label><br>
            <label>Дата публикации: <input type="date" name="publication_date" required></label><br>
            <button type="submit">Добавить рецензию</button>
        </form>

        <h2>Список всех рецензий</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Пользователь ID</th>
                <th>Книга ID</th>
                <th>Заголовок</th>
                <th>Текст</th>
                <th>Дата публикации</th>
            </tr>
            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?php echo htmlspecialchars($review['id']); ?></td>
                    <td><?php echo htmlspecialchars($review['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($review['book_id']); ?></td>
                    <td><?php echo htmlspecialchars($review['title']); ?></td>
                    <td><?php echo htmlspecialchars($review['text']); ?></td>
                    <td><?php echo htmlspecialchars($review['publication_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>

</body>
</html>
