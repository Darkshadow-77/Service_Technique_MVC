<?php
require_once __DIR__.'/../models/Service.php';
require_once __DIR__.'/../utils/db.php';
class ServiceController {
    public function list() {
        $db = getPDO();
        $service = new Service($db);
        $services = $service->getAll();
        require __DIR__.'/../views/services.php';
    }
} 