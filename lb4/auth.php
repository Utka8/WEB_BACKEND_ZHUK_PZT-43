<?php 
session_start();
$password = "1";
$login = "admin";
$login1 = $_POST['login'] ?? '';
$password1 = $_POST['password'] ?? '';
if ($password == $password1 && $login == $login1) {
    $_SESSION['admin'] = true;
    header("Location: admin.php");
    exit;
} 
else if ($login1 != '' && $password1 != '') {
    echo "Неверный логин или пароль";
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form name="form" method="post">
            <div>
                <label for="login">Логин</label>
                <input type="text" name="login" required autocomplete="off">
            </div>
            <div>
                <label for="password">Пароль</label>
                <input type="password" name="password" required autocomplete="off">
            </div>
            <button type="submit">Войти</button>
        </form>
    </div>
</body>

</html>