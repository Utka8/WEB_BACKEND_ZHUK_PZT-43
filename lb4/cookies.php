<?php
if (isset($_COOKIE['counter'])) {
    $count = $_COOKIE['counter'] + 1;
} 
else {
    $count = 1;
}

setcookie("counter", $count, time() + 3600);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Cookies</title>
</head>

<body>

    <p>Вы посетили эту страницу: <?php echo $count; ?> раз.</p>

</body>

</html>