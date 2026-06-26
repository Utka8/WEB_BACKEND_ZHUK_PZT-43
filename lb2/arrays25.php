<h2>5. Массивы</h2>
<?php
mb_internal_encoding("UTF-8");

echo "<pre>";

// 1. Инициализация и доступ
echo "1. Инициализация и доступ\n";

$arr = [3, 1, 5, 2, 4];
echo "Индексированный массив: ";
print_r($arr);

$user = ["name" => "Анастасия", "age" => 18];
echo "Ассоциативный массив: ";
print_r($user);

$matrix = [
    [1, 2],
    [3, 4]
];
echo "Многомерный массив: ";
print_r($matrix);

echo "Первый элемент массива arr: " . $arr[0] . "\n";
echo "Имя пользователя: " . $user['name'] . "\n";
echo "Элемент матрицы [1][1]: " . $matrix[1][1] . "\n";

$arr[] = 10;
$removed = array_shift($arr);
echo "Удалён первый элемент arr: $removed\n";

$user['city'] = "Минск";
$user['age'] = 19; // перезапись
echo "Обновлённый user: ";
print_r($user);


// 2. Перебор foreach
echo "\n2. Перебор foreach\n";

foreach ($user as $key => $value)
    echo "$key: $value\n";

$colors = ['red', 'green', 'blue', 'yellow'];
foreach ($colors as &$c) $c = strtoupper($c);
unset($c);
print_r($colors);


// 3. Сортировка
echo "\n3. Сортировка\n";

sort($arr);
echo "sort: ";
print_r($arr);

rsort($arr);
echo "rsort: ";
print_r($arr);

$prices = ["яблоко" => 50, "банан" => 20, "киви" => 80];

asort($prices);
echo "asort: ";
print_r($prices);

arsort($prices);
echo "arsort: ";
print_r($prices);

ksort($prices);
echo "ksort: ";
print_r($prices);

krsort($prices);
echo "krsort: ";
print_r($prices);

$nums3 = [5, 12, 3, 8, 1];
usort($nums3, fn($a, $b) => ($a % 10) <=> ($b % 10));
echo "usort (по последней цифре): ";
print_r($nums3);

$files = ["file10.txt", "file2.txt", "file1.txt"];
natcasesort($files);
echo "natcasesort: ";
print_r($files);


// 4. Поиск и проверка
echo "\n4. Поиск и проверка\n";

if (!in_array('ORANGE', $colors)) $colors[] = 'ORANGE';

echo "Ключ 'age' существует в user? ";
var_dump(array_key_exists('age', $user));

echo "Индекс 'YELLOW' в colors: ";
var_dump(array_search('YELLOW', $colors));


// 5. Работа с частью массива
echo "\n5. Работа с частью массива\n";

$first3 = array_slice($colors, 0, 3);
print_r($first3);

$removedUser = array_splice($arr, 1, 1);
echo "Удалён элемент из arr:\n";
print_r($removedUser);

$merged = array_merge($colors, ['PINK', 'BROWN']);
print_r($merged);


// 6. Преобразование массивов
echo "\n6. Преобразование массивов\n";

$agesOnly = array_column([$user], 'age');
print_r($agesOnly);

$colorLengths = array_combine($colors, array_map('strlen', $colors));
print_r($colorLengths);

print_r(array_keys($prices));
print_r(array_values($prices));


// 7. Функции высшего порядка
echo "\n7. Функции высшего порядка\n";

$nums = [3, 10, 7, 2, 8, 15];
$filtered = array_filter($nums, fn($n) => $n > 5);
print_r($filtered);

$mapped = array_map(fn($n) => $n * 2, $nums);
print_r($mapped);

$sum = array_reduce($nums, fn($acc, $n) => $acc + $n, 0);
echo "Сумма элементов: $sum\n";


// 8. Случайные элементы
echo "\n8. Случайные элементы\n";

$randKeys = array_rand($colors, 2);
echo $colors[$randKeys[0]] . ", " . $colors[$randKeys[1]] . "\n";

shuffle($colors);
print_r($colors);

echo "</pre>";
?>
