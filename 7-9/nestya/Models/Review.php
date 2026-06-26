<?php
namespace Models;

use PDO;

class Review {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function getReviewsPage($page, $perPage) {
        $offset = ($page - 1) * $perPage;
        
        // В PDO для LIMIT и OFFSET нужно передавать параметры как INT, либо использовать bindValue
        $stmt = $this->db->prepare("SELECT * FROM reviews ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Получить общее количество отзывов
    public function getTotalCount() {
        return (int)$this->db->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
    }

    // Получить все отзывы из базы данных
    public function getAllReviews() {
        $stmt = $this->db->query("SELECT * FROM reviews ORDER BY id DESC");
        return $stmt->fetchAll();
    }
}