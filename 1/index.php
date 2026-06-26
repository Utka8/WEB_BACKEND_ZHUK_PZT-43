<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа</title>
</head>
<body>

    <h2>Регистрация абитуриента</h2>
    <form action="process.php" method="POST">
        <input type="text" name="fname" placeholder="First Name (required)" required><br>
        <input type="text" name="lname" placeholder="Last Name (required)" required><br>
        <input type="email" name="email" placeholder="Email (required)" required><br>
        <input type="text" name="phone" placeholder="Phone"><br>
        <button type="submit">Send</button>
    </form>

</body>
</html>