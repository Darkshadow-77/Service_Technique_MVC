<?php
class Service {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id) {
        // Get a service by ID (to complete)
    }
} 