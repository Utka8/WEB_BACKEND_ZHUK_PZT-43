<?php
// Примеры переменных разных типов

$name = "Жук Анастасия Сергеевна"; // string
$age = 18; // integer
$height = 1.65; // float
$is_student = true; // boolean

echo "<h2>Переменные разных типов</h2>";
echo "Имя: $name<br>";
echo "Возраст: $age<br>";
echo "Рост: $height<br>";
print "Студент: " . ($is_student ? "Да" : "Нет") . "<br>";
