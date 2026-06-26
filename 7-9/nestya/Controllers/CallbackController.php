<?php

namespace Controllers;

use Models\Callback;

class CallbackController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showForm()
    {
        $errors = [];
        $success = false;

        // Если форма была отправлена методом POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['parent_name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $age = trim($_POST['child_age'] ?? '');

            // Валидация полей на PHP
            if (empty($name)) $errors[] = "Введите ваше имя.";
            if (empty($phone)) $errors[] = "Укажите номер телефона для связи.";
            if (empty($age) || !is_numeric($age) || $age < 7 || $age > 16) {
                $errors[] = "Возраст ребенка должен быть числом от 7 до 16 лет.";
            }

            // Если ошибок нет — сохраняем в БД
            if (empty($errors)) {
                $callbackModel = new Callback($this->db);
                if ($callbackModel->createRequest($name, $phone, $age)) {
                    $success = true;
                } else {
                    $errors[] = "Произошла ошибка при сохранении в базу данных.";
                }
            }
        }

        // Подключаем шаблон формы внутри основного layout.php сайта
        $view = 'Views/callback.php';
        include 'Views/layout.php';
    }

    public function showAdminPanel()
    {
        $callbackModel = new \Models\Callback($this->db);

        // Сбор параметров фильтрации и поиска из URL
        $search = trim($_GET['search'] ?? '');
        $ageFilter = trim($_GET['age'] ?? '');
        $sortBy = trim($_GET['sort_by'] ?? 'id');
        $sortDir = trim($_GET['sort_dir'] ?? 'DESC');

        // Получаем отфильтрованные данные
        $requests = $callbackModel->getFilteredRequests($search, $ageFilter, $sortBy, $sortDir);

        // Подключаем отображение
        $view = 'Views/admin_callbacks.php';
        include 'Views/layout.php';
    }

    public function addToCart()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            $_SESSION['cart'][$id] = true;
        }

        // Сохраняем параметры фильтрации для возврата назад
        $redirectParams = $_GET;
        $redirectParams['action'] = 'sort'; // возвращаемся в админку
        unset($redirectParams['id']);       // убираем id из ссылки возврата

        header("Location: ?" . http_build_query($redirectParams));
        exit;
    }

    public function deleteFromCart()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0 && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        // Сохраняем параметры фильтрации для возврата назад
        $redirectParams = $_GET;
        $redirectParams['action'] = 'sort'; // возвращаемся в админку
        unset($redirectParams['id']);       // убираем id из ссылки возврата

        header("Location: ?" . http_build_query($redirectParams));
        exit;
    }

    // Полная очистка корзины
    public function clearCart()
    {
        unset($_SESSION['cart']);
        header("Location: ?action=sort");
        exit;
    }
}
