<?php
require_once __DIR__.'/../models/Service.php';
class ServiceController {
    public function list() {
        // Database connection (to adapt with your parameters)
        $db = new PDO('mysql:host=localhost;dbname=t-service', 'root', '');
        $service = new Service($db);
        $services = $service->getAll();
        require __DIR__.'/../views/services.php';
    }
} 