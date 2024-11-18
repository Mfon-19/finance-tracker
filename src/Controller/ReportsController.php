<?php

namespace App\Controller;

class ReportsController {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index() {
        require_once __DIR__ . '/../../src/View/reports.php';
    }
}
