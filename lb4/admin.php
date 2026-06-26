<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: auth.php");
    exit;
}

if (!isset($_SESSION['admin'])) {
    header("Location: auth.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Админ панель</title>
</head>

<body>

    <h1>Добро пожаловать в админ панель!</h1>

    <a href="admin.php?logout=1">Выйти</a>

</body>

</html>