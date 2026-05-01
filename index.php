<?php
session_start();
// Устанавливаем cookie для ЛР4 ДО вывода HTML
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
    <title>Лабораторная №1 — ссылки</title>
</head>
<body>
    <h1>Лабораторная работа №1</h1> 
    <p><a href="phpinfo.php">Информация phpinfo()</a></p>
    <p><a href="hello.php">Привет всем + информация о разработчике</a></p>
    <p><a href="variables.php">Переменные разных типов</a></p>
    <p><a href="constants.php">Константы и предопределённые константы</a></p>
    <p><a href="superglobals.php">Предопределённые переменные (superglobals)</a></p>
    <hr>
    <?php include "lb2.php"; ?> 
    <hr>
    <?php include "lb3.php"; ?> 
    <hr>
    <?php include "lb4.php"; ?> 

</html>
