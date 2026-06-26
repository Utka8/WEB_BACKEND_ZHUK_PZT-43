<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Задание 2.1: Сохранение в сессию
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phone'] = $_POST['phone'];

    // Задание 3.1: Создание переменных
    $a = $_POST['fname'];
    $b = $_POST['lname'];
    
    // Задание 3.2: Запись в файл fio.txt
    file_put_contents('fio.txt', "First Name: $a\nLast Name: $b");
    
    // Дополнительно: сохраняем всех абитуриентов в список (вместо БД)
    $entry = "$b $a | " . $_POST['email'] . "\n";
    file_put_contents('applicants.txt', $entry, FILE_APPEND);

    header("Location: page2.php");
    exit();
}
?>