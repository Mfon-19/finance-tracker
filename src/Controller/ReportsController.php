<?php

namespace App\Controller;
use App\Model\User;

class ReportsController {
    private $conn;
    private $user;
    public function __construct($conn) {
        $this->conn = $conn;
        $this->user = new User($conn);
    }

    public function showReports($id) {
        $transactions = $this->user->getTransactionsById($id);
        $income = $this->user->getTotalIncomeById($id);
        $expenses = $this->user->getTotalExpensesById($id);
        $goals = $this->user->getGoalsById($id);
        $topCategories = $this->user->getTopCategoriesById($id);
        require_once __DIR__ . '/../../src/View/reports.php';
    }
}
