<?php
namespace Controllers;

use Models\Review;

class ReviewController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $reviewModel = new Review($this->db);
        
        // Настройки пагинации
        $perPage = 2; // Сколько отзывов отображать на одной странице
        $currentPage = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
        
        // Получаем данные
        $totalReviews = $reviewModel->getTotalCount();
        $totalPages = ceil($totalReviews / $perPage);
        
        // Корректируем текущую страницу, если она превышает максимум
        if ($currentPage > $totalPages && $totalPages > 0) {
            $currentPage = $totalPages;
        }

        $reviews = $reviewModel->getReviewsPage($currentPage, $perPage);

        $view = 'Views/reviews.php';
        include 'Views/layout.php';
    }
}