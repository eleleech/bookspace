<?php
class Database {
    private $host = 'db-mysql';          // Адрес сервера БД
    private $dbName = 'web2024-yudinaleache';   // Имя базы данных
    private $username = 'web2024-yudinaleache'; // Имя пользователя БД
    private $password = 'web2024-yudinaleache'; // Пароль пользователя
    private $pdo = null;                // Экземпляр PDO

    // Метод для подключения к базе данных
    public function getConnection() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4"; // Включение кодировки
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Устанавливаем режим ошибок
            return $this->pdo;
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage()); // Если ошибка
        }
    }
}
?>
