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