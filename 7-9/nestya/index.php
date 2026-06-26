<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

require_once 'config/db.php';

$db = connectDB();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller = new \Controllers\ReviewController($db);
        $controller->index();
        break;

    case 'callback':
        $controller = new \Controllers\CallbackController($db);
        $controller->showForm();
        break;

    case 'sort':
        $controller = new \Controllers\CallbackController($db);
        $controller->showAdminPanel();
        break;

    case 'cart-add':
        $controller = new \Controllers\CallbackController($db);
        $controller->addToCart();
        break;

    case 'cart-delete':
        $controller = new \Controllers\CallbackController($db);
        $controller->deleteFromCart();
        break;

    case 'cart-clear':
        $controller = new \Controllers\CallbackController($db);
        $controller->clearCart();
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Страница не найдена</h1>";
        break;
}
