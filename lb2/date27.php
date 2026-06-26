<h2>7. Использование встроенных математических функций, 
    работа с датой, временем, календарем, функции обработки 
    массивов, строковые функции. 
</h2>
<?php
echo "abs(-10) = " . abs(-10) . "<br>";
echo "pow(2, 3) = " . pow(2, 3) . "<br>";
echo "sqrt(16) = " . sqrt(16) . "<br>";
echo "round(3.14159, 2) = " . round(3.14159, 2) . "<br>";
echo "rand(1, 10) = " . rand(1, 10) . "<br>";

echo "<br><strong>Дата и время:</strong><br>";
echo "Сейчас: " . date("H:i:s") . "<br>";
echo "Сегодня: " . date("d.m.Y") . "<br>";
// strtotime — преобразование строки в timestamp
echo "Через день: " . date("d.m.Y", strtotime("+1 day")) . "<br>";

//сортировка по возрастанию
$nums = [5, 2, 9, 1];
sort($nums);
echo "<br>sort: ";
print_r($nums);

//фильтрация массива по условию (>3)
$filtered = array_filter($nums, fn($n) => $n > 3);
echo "<br>array_filter (>3): ";
print_r($filtered);

//применяет функцию к каждому элементу и умножаем каждый элемент на 2
$mapped = array_map(fn($n) => $n * 2, $nums);
echo "<br>array_map (*2): ";
print_r($mapped);
?>