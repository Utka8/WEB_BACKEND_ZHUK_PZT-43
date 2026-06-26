<h2>1. Типы данных</h2>
<?php
// Скалярные типы
$int = 42;
$float = 3.14;
$string = "Привет, мир!";
$bool = true;

// Специальные типы
$null = null;

// Вывод
echo "int: $int<br>";
echo "float: $float<br>";
echo "string: $string<br>";
echo "bool: " . ($bool ? "true" : "false") . "<br>";
echo "null: ";
var_dump($null);

// Явное приведение типов
echo "<br><br><strong>Явное приведение типов:</strong><br>";
echo "(int)3.99 = " . (int)3.99 . "<br>";
echo "(string)123 = " . (string)123 . "<br>";

// Неявное приведение
echo "<br><strong>Неявное приведение:</strong><br>";
echo "5 + '10' = " . (5 + '10') . "<br>";
?>