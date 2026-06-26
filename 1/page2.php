<?php
session_start();
echo "<h2>Результаты сессии:</h2>";
echo "Email: " . ($_SESSION['email'] ?? 'не задан') . "<br>";
echo "Телефон: " . ($_SESSION['phone'] ?? 'не задан') . "<br>";
echo "<b>ID сессии:</b> " . session_id() . "<br><hr>";

echo "<h2>Список всех абитуриентов (из файла):</h2>";
if (file_exists('applicants.txt')) {
    echo nl2br(file_get_contents('applicants.txt'));
}
echo "<br><a href='index.php'>Вернуться назад</a>";
?>