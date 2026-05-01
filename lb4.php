<?php
// Лабораторная работа №4 — Сессии и Cookies
?>

<h2>Лабораторная работа №4 — Сессии и Cookies</h2>

<hr>

<!-- сессии-->
<h3>Задание 1 — Счётчик просмотров страницы (сессии)</h3>

<?php
// Счётчик просмотров
if (!isset($_SESSION['lb4_views'])) {
    $_SESSION['lb4_views'] = 0;
}
$_SESSION['lb4_views']++;
?>

<p>Количество просмотров этой лабораторной: <b><?= $_SESSION['lb4_views'] ?></b></p>

<hr>

<!--Cookies-->
<h3>Задание 2 — Работа с Cookies</h3>

<p>Ваш предыдущий визит: <b><?= htmlspecialchars($lastVisit) ?></b></p>

<hr>

<!-- Авторизация -->
<h3>Задание 3 — Авторизация с помощью сессий</h3>

<?php
// Выход
if (isset($_GET['logout'])) {
    unset($_SESSION['lb4_user']);
    echo "<script>location.href='" . $_SERVER['PHP_SELF'] . "';</script>";
    exit;
}

// Если пользователь авторизован
if (isset($_SESSION['lb4_user'])) {
    echo "<p>Вы вошли как <b>{$_SESSION['lb4_user']}</b></p>";
    echo '<p><a href="?logout=1">Выйти</a></p>';

} else {

    // Обработка формы входа
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {

        $login = trim($_POST['login']);
        $pass  = trim($_POST['password']);

        // Данные администратора
        $validLogin = "admin";
        $validPass  = "12345";

        if ($login === $validLogin && $pass === $validPass) {
            $_SESSION['lb4_user'] = $login;
            echo "<script>location.href='" . $_SERVER['PHP_SELF'] . "';</script>";
            exit;
        } else {
            echo "<p style='color:red'>Неверный логин или пароль</p>";
        }
    }
?>

<form method="post">
    <input type="text" name="login" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit" name="login_btn">Войти</button>
</form>

<?php } ?>

<hr>
