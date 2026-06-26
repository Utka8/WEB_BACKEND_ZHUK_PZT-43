<h1>Лабораторная №2</h1>
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
<h2>3. Операторы PHP</h2>
<?php
// 1. Присваивание
$a = 10;
$b = $a;
echo "a = $a, b = $b<br>";

// 2. Условные операторы
echo "<br><strong>Условные операторы:</strong><br>";

$age = 17;

// if
if ($age >= 18) {
    echo "Совершеннолетний<br>";
}

// if/else
if ($age >= 18) {
    echo "Доступ разрешён<br>";
} else {
    echo "Доступ запрещён<br>";
}

// if/elseif/else
$score = 75;
if ($score >= 90) {
    echo "Отлично<br>";
} elseif ($score >= 70) {
    echo "Хорошо<br>";
} else {
    echo "Удовлетворительно<br>";
}

// Тернарный оператор
echo ($age >= 18) ? "Можно войти<br>" : "Нельзя войти<br>";

// 3. Множественный выбор
echo "<br><strong>switch:</strong><br>";
$day = 2;
switch ($day) {
    case 1: echo "Понедельник<br>"; break;
    case 2: echo "Вторник<br>"; break;
    case 3: echo "Среда<br>"; break;
    default: echo "Неизвестный день<br>";
}

echo "<br><strong>match:</strong><br>";
$grade = 4;
$result = match ($grade) {
    5 => "Отлично",
    4 => "Хорошо",
    3 => "Удовлетворительно",
    default => "Неизвестно"
};
echo "match: $result<br>";

// 4. Циклы
echo "<br><strong>Циклы:</strong><br>";

// while
$i = 1;
while ($i <= 3) {
    echo "while: $i<br>";
    $i++;
}

// do...while
$j = 1;
do {
    echo "do...while: $j<br>";
    $j++;
} while ($j <= 3);

// for
for ($k = 1; $k <= 3; $k++) {
    echo "for: $k<br>";
}

// foreach
$arr = ["яблоко", "груша", "банан"];
foreach ($arr as $fruit) {
    echo "foreach: $fruit<br>";
}

// 5. Переходы
echo "<br><strong>Переходы:</strong><br>";

// break
for ($x = 1; $x <= 5; $x++) {
    if ($x == 3) break;
    echo "break пример: $x<br>";
}

// continue
for ($y = 1; $y <= 5; $y++) {
    if ($y == 3) continue;
    echo "continue пример: $y<br>";
}

// goto
echo "goto пример: ";
goto label;
echo "Этот текст не будет выведен";
label:
echo "перешли по метке<br>";

// 6. Включения
echo "<br><strong>Включения файлов:</strong><br>";
echo "include('file.php') — предупреждение при отсутствии файла<br>";
echo "include_once('file.php') — подключает один раз<br>";
echo "require('file.php') — фатальная ошибка при отсутствии файла<br>";
echo "require_once('file.php') — подключает один раз, обязательно наличие<br>";
?>


<h2>4. Пользовательские функции</h2>
<?php
function greet($name) {
    return "Привет, $name!";
}
echo greet("Анастасия") . "<br>";

function sum($a, $b = 10) {
    return $a + $b;
}
echo "sum(5) = " . sum(5) . "<br>";

$mul = fn($x, $y) => $x * $y;
echo "Стрелочная функция: " . $mul(3, 4) . "<br>";
?>
<h2>5. Массивы</h2>
<?php
$arr = [3, 1, 5, 2, 4];
echo "Индексированный: ";
print_r($arr);

$user = ["name" => "Анастасия", "age" => 18];
echo "<br>Ассоциативный: ";
print_r($user);

$matrix = [
    [1, 2],
    [3, 4]
];
echo "<br>Многомерный: ";
print_r($matrix);

echo "<br><strong>foreach:</strong><br>";
foreach ($user as $key => $value) {
    echo "$key: $value<br>";
}

echo "<hr><h3>Сортировки массивов</h3>";

// sort — сортировка по возрастанию
$nums1 = [5, 2, 9, 1];
sort($nums1);
echo "sort (по возрастанию): ";
print_r($nums1);

// rsort — сортировка по убыванию
$nums2 = [5, 2, 9, 1];
rsort($nums2);
echo "<br>rsort (по убыванию): ";
print_r($nums2);

// asort — сортировка ассоциативного массива по значению
$prices = ["яблоко" => 50, "банан" => 20, "киви" => 80];
asort($prices);
echo "<br>asort (по значению ↑): ";
print_r($prices);

// arsort — сортировка ассоциативного массива по значению (убывание)
arsort($prices);
echo "<br>arsort (по значению ↓): ";
print_r($prices);

// ksort — сортировка по ключам
ksort($prices);
echo "<br>ksort (по ключам ↑): ";
print_r($prices);

// krsort — сортировка по ключам (убывание)
krsort($prices);
echo "<br>krsort (по ключам ↓): ";
print_r($prices);

// usort — пользовательская сортировка
$nums3 = [5, 12, 3, 8, 1];
usort($nums3, function($a, $b) {
    return ($a % 10) <=> ($b % 10); // сортировка по последней цифре
});
echo "<br>usort (по последней цифре): ";
print_r($nums3);

// natcasesort — естественная сортировка строк
$files = ["file10.txt", "file2.txt", "file1.txt"];
natcasesort($files);
echo "<br>natcasesort (естественная сортировка): ";
print_r($files);
?>

<h2>6. Строковый тип данных</h2>
<?php
$text = "Привет, мир!";

echo "Длина: " . mb_strlen($text) . "<br>";
echo "Подстрока: " . mb_substr($text, 0, 6) . "<br>";
echo "Позиция 'мир': " . mb_strpos($text, "мир") . "<br>";
echo "Замена: " . str_replace("мир", "PHP", $text) . "<br>";

$words = explode(" ", "яблоко груша банан");
echo "explode: ";
print_r($words);

echo "<br>implode: " . implode(", ", $words) . "<br>";
?>


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
echo "Через день: " . date("d.m.Y", strtotime("+1 day")) . "<br>";

$nums = [5, 2, 9, 1];
sort($nums);
echo "<br>sort: ";
print_r($nums);

$filtered = array_filter($nums, fn($n) => $n > 3);
echo "<br>array_filter (>3): ";
print_r($filtered);

$mapped = array_map(fn($n) => $n * 2, $nums);
echo "<br>array_map (*2): ";
print_r($mapped);
?>