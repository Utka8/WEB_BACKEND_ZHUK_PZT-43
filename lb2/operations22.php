<h2>2. Операции PHP</h2>
<?php
$a = 10;
$b = 3;

// Арифметические операции
echo "a + b = " . ($a + $b) . "<br>";
echo "a - b = " . ($a - $b) . "<br>";
echo "a * b = " . ($a * $b) . "<br>";
echo "a / b = " . ($a / $b) . "<br>";
echo "a % b = " . ($a % $b) . "<br>";

// Строковые операции
echo "<br><strong>Строковые операции:</strong><br>";
echo "Конкатенация: " . ("Hello " . "World") . "<br>";

// Сравнение
echo "<br><strong>Сравнение:</strong><br>";
var_dump(5 == "5");
var_dump(5 === "5");

// Логические операции
echo "<br><strong>Логические операции:</strong><br>";
var_dump(true && false);
var_dump(true || false);

// Инкремент/декремент
echo "<br><strong>Инкремент/декремент:</strong><br>";
$x = 5;
echo "x++ = " . $x++ . "<br>";
echo "Теперь x = $x<br>";
?>