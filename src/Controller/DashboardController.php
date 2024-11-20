<?php

namespace App\Controller;
use App\Model\User;

class DashboardController {
    private $conn;
    private $userModel;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->userModel = new User($conn);
    }

    public function showDashboard($id) {
        $user = $this->userModel->getUserById($id);
        $transactions = $this->userModel->getTransactionsById($id);
        $balance = $this->userModel->getCurrentBalanceById($id);
        $goals = $this->userModel->getGoalsById($id);
        require_once __DIR__ . '/../../src/View/dashboard.php';
    }

    public function addTransaction($id, $amount, $type, $category, $description, $date) {
        $result = $this->userModel->addTransaction($id, $amount, $type, $category, $description, $date);
        if($result) {
            header('Location: /dashboard');
        } else {
            echo 'Error adding transaction';
        }
    }

    public function addGoal($id, $goalName, $targetAmount, $targetDate) {
        $result = $this->userModel->addGoal($id, $goalName, $targetAmount, $targetDate);
        if($result) {
            header('Location: /dashboard');
        } else {
            echo 'Error adding goal';
        }
    }
}
