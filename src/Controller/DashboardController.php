<?php

namespace App\Controller;

class DashboardController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index() {
        require_once __DIR__ . '/../../src/View/dashboard.php';
    }
}
