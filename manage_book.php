<?php
require_once 'logic/book.php';
$book = new Book();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? null;

    if (isset($_POST['add'])) {
        $book->addBook($title);
    } elseif (isset($_POST['update'])) {
        $book->updateBook($id, $title);
    } elseif (isset($_POST['delete'])) {
        $book->deleteBook($id);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$books = $book->getAllBooks();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление книгами</title>
   <style>
    body {
        font-family: 'Arial', sans-serif;
        background: #FEFAE0;
        padding: 30px;
    }
    h2 {
        color: #333;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        background: #fff;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ccc;
    }
    th {
        background: #C9CBA3;
        color: #333;
    }
    .actions form {
        display: inline-block;
    }
    .back-button {
        display: inline-block;
        margin-bottom: 20px;
        padding: 5px 10px;
        background: #C9CBA3;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
    }
    .back-button:hover {
        background: #b0b38d;
    }
</style>


</head>
<body>

<a href="i.html" class="back-button">На главную</a>

<h2>Управление книгами</h2>

<form method="POST">
    <input type="hidden" name="id" value="">
    <input type="text" name="title" placeholder="Название книги" required>
    <button name="add">Добавить</button>
</form>

<table>
    <tr><th>ID</th><th>Название</th><th>Действия</th></tr>
    <?php foreach ($books as $b): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= htmlspecialchars($b['title']) ?></td>
            <td class="actions">
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                    <input type="text" name="title" value="<?= htmlspecialchars($b['title']) ?>" required>
                    <button name="update">Обновить</button>
                </form>
                <form method="POST" onsubmit="return confirm('Удалить эту книгу?');">
                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                    <button name="delete">Удалить</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
