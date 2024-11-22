<?php

namespace App\Model;

class User {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function login($username){
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function signup($firstname, $lastname, $email, $phone, $username, $password){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (first_name, last_name, email, phone, username, password) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phone, $username, $hashedPassword);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getUserById($id){
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getTransactionsById($id, $order, $limit = 3){
        $sql = "SELECT * FROM transactions WHERE user_id = ? ORDER BY transaction_date " . ($order === 'DESC' ? 'DESC' : 'ASC') . " LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getCurrentBalanceById($id){
        $income = $this->getTotalIncomeById($id);
        $expense = $this->getTotalExpensesById($id);
        return number_format($income['total_income'] - $expense['total_expenses'], 2, '.', '');
    }

    public function getTotalIncomeById($id){
        $sql = "SELECT COALESCE(SUM(amount), 0) AS total_income FROM transactions WHERE user_id = ? AND transaction_type = 'income'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getTotalExpensesById($id){
        $sql = "SELECT COALESCE(SUM(amount), 0) AS total_expenses FROM transactions WHERE user_id = ? AND transaction_type = 'expense'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getTopExpenseCategoriesById($id){
        $sql = "SELECT category, COALESCE(SUM(amount), 0) AS total_amount FROM transactions WHERE user_id = ? AND transaction_type = 'expense' GROUP BY category ORDER BY total_amount DESC LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getGoalsById($id){
        $sql = "SELECT * FROM savings_goals WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function addTransaction($id, $amount, $type, $category, $description, $date){
        $sql = "INSERT INTO transactions (user_id, transaction_type, amount, category, description, transaction_date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isdsss", $id, $type, $amount, $category, $description, $date);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function addGoal($id, $goalName, $targetAmount, $targetDate){
        $sql = "INSERT INTO savings_goals (user_id, goal_name, target_amount, goal_deadline) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isds", $id, $goalName, $targetAmount, $targetDate);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function editGoal($id, $amount, $name) {
        $this->conn->begin_transaction();

        try {
            $sql = "UPDATE savings_goals SET current_amount = current_amount + ?, updated_at = CURRENT_TIMESTAMP WHERE goal_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("di", $amount, $id);
            $result = $stmt->execute();
            $stmt->close();
            $this->addTransaction($_SESSION['user_id'], $amount, 'Expense', 'Savings Goal', 'Put some money towards goal: '. $name, date('Y-m-d'));
            $this->conn->commit();
            return $result;
        } catch (\Throwable $th) {
            $this->conn->rollback();
            return false;
        }
    }
}