<?php

namespace Models;

use PDO;

class Callback
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Сохранение новой заявки в базу данных
    public function createRequest($name, $phone, $age)
    {
        $stmt = $this->db->prepare("INSERT INTO callback_requests (parent_name, phone, child_age) VALUES (:name, :phone, :age)");
        return $stmt->execute([
            ':name' => $name,
            ':phone' => $phone,
            ':age' => (int)$age
        ]);
    }

public function getFilteredRequests($search, $ageFilter, $sortBy, $sortDir)
    {
        $sql = "SELECT * FROM callback_requests WHERE 1=1";
        $params = [];

        // 1. Поиск: используем уникальные имена для плейсхолдеров
        if (!empty($search)) {
            $sql .= " AND (parent_name LIKE :search_name OR phone LIKE :search_phone)";
            $params[':search_name'] = '%' . $search . '%';
            $params[':search_phone'] = '%' . $search . '%';
        }

        // 2. Фильтрация по возрасту
        if (!empty($ageFilter)) {
            $sql .= " AND child_age = :age";
            $params[':age'] = (int)$ageFilter;
        }

        // 3. Сортировка (безопасная)
        $allowedSortFields = ['id', 'parent_name', 'child_age', 'created_at'];
        $allowedDirections = ['ASC', 'DESC'];

        $sortBy = in_array($sortBy, $allowedSortFields) ? $sortBy : 'id';
        $sortDir = in_array($sortDir, $allowedDirections) ? $sortDir : 'DESC';

        $sql .= " ORDER BY $sortBy $sortDir";

        // ВЫПОЛНЕНИЕ
        $stmt = $this->db->prepare($sql);
        
        // Теперь количество :search_name, :search_phone и :age в SQL 
        // точно совпадает с ключами в $params
        $stmt->execute($params);
        
        return $stmt->fetchAll();
    }
}
?>