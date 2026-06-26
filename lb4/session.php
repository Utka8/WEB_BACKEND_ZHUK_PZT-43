<?php
// 1. Вся логика в самом начале
session_start();

// Логика счетчика (сессии)
if (!isset($_SESSION['lb4_views'])) {
    $_SESSION['lb4_views'] = 0;
}
$_SESSION['lb4_views']++;

// Логика Cookies
if (!isset($_COOKIE['lb4_last_visit'])) {
    $lastVisit = "Вы здесь впервые";
} else {
    $lastVisit = $_COOKIE['lb4_last_visit'];
}
setcookie("lb4_last_visit", date("Y-m-d H:i:s"), time() + 86400 * 30, "/");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная №4</title>
</head>
<body>

    <h3>Задание 1 — Счётчик просмотров страницы</h3>
    <p>Количество просмотров: <b><?= $_SESSION['lb4_views'] ?></b></p>

    <hr>

    <h3>Задание 2 — Работа с Cookies</h3>
    <p>Ваш предыдущий визит: <b><?= htmlspecialchars($lastVisit) ?></b></p>

    <hr>
    <a href="../index.php">Назад к списку</a>

</body>
</html>