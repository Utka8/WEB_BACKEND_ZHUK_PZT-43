<h2>6. Строковый тип данных</h2>
<?php
mb_internal_encoding("UTF-8");

echo "<pre>";

// Исходные данные
$text = "Привет, мир!";
$comment = "<b>Классный сайт!</b> <script>alert('XSS');</script>";
$price = " 2 345,90 руб. ";
$csv = "Петров;Анастасия;test@mail.com;18;Минск";
$name = "Анастасия";
$slug = "как дела сегодня";


// 1. Способы записи строк
echo "1. Способы записи строк\n";

echo 'Одинарные: Привет, $name!' . "\n";
echo "Двойные: Привет, $name!\n";

echo <<<TXT
HEREDOC пример:
Привет, $name!
Как проходит день?
TXT;


// 2. Доступ к символам
echo "\n\n2. Доступ к символам\n";
echo "Первый символ через индекс: " . $text[0] . "\n";
echo "Первый символ через mb_substr: " . mb_substr($text, 0, 1) . "\n";

// Замена первой буквы
$chars = mb_str_split($slug);
$chars[0] = mb_strtoupper($chars[0]);
$slug2 = implode("", $chars);
echo "После замены первой буквы: $slug2\n";


// 3. Операции со строками
echo "\n3. Операции со строками\n";
$str = "Имя пользователя: ";
$str .= $name;
echo $str . "\n";

echo "123 == '123'? ";
var_dump(123 == "123");

echo "123 === '123'? ";
var_dump(123 === "123");


// 4. Длина строки
echo "\n4. Длина строки\n";
echo "strlen: " . strlen($text) . "\n";
echo "mb_strlen: " . mb_strlen($text) . "\n";


// 5. Поиск подстроки
echo "\n5. Поиск подстроки\n";
echo "Позиция 'мир': " . mb_strpos($text, "мир") . "\n";

echo "str_contains 'PHP': ";
var_dump(str_contains($text, "PHP"));

echo "Количество 'и' в строке: ";
var_dump(substr_count(mb_strtolower($text), "и"));


// 6. Извлечение части строки
echo "\n6. Извлечение части строки\n";
echo "Первые 6 символов: " . mb_substr($text, 0, 6) . "\n";
echo "Последние 5 символов: " . mb_substr($text, -5) . "\n";


// 7. Замена
echo "\n7. Замена\n";
echo str_replace("мир", "PHP", $text) . "\n";
echo str_replace(" ", "_", $text) . "\n";


// 8. Удаление пробелов и преобразование цены
echo "\n8. Работа с ценой\n";
$clean = trim($price);
echo "trim: '$clean'\n";

$clean = str_replace(["руб.", " ", ","], ["", "", "."], $clean);
$floatPrice = (float)$clean;
echo "float: $floatPrice\n";


// 9. Изменение регистра
echo "\n9. Регистры\n";
echo mb_strtolower($slug) . "\n";
echo mb_strtoupper($slug) . "\n";
echo mb_convert_case($slug, MB_CASE_TITLE) . "\n";


// 10. Разбиение и объединение
echo "\n10. Разбиение и объединение\n";
$parts = explode(";", $csv);
echo "Фамилия: {$parts[0]}\nИмя: {$parts[1]}\nEmail: {$parts[2]}\n";

echo implode("|", $parts) . "\n";

echo implode(", ", mb_str_split($name)) . "\n";


// 11. Безопасный вывод
echo "\n11. Безопасный вывод\n";
echo htmlspecialchars($comment) . "\n";
echo strip_tags($comment) . "\n";

echo "Используйте htmlspecialchars для защиты от XSS.\n";


// 12. Форматирование
echo "\n12. Форматирование\n";
$student = ['name' => 'Анастасия', 'age' => 18, 'grade' => 854.3];
echo sprintf("Студент %s, возраст %d, оценка %.1f\n",
    $student['name'], $student['age'], $student['grade']
);

echo number_format(98765.4321, 2, ',', ' ') . "\n";

echo "</pre>";
?>
