<?php
function connectDB() {
    $host = '127.0.1.0';
    $db   = 'spacampdb'; //название бд
    $user = 'root';
    $pass = '14146137Utka'; //пароль от SQL server
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}
?>