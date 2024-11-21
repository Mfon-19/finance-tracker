<?php

namespace App\Model;

class User {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function login($username){
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $user = $this->conn->query($sql);
        return $user->fetch_assoc();
    }

    public function signup($firstname, $lastname, $email, $phone, $username, $password){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (first_name, last_name, email, phone, username, password) 
        VALUES ('$firstname', '$lastname', '$email', '$phone', '$username', '$hashedPassword')";

        // true if insert is successful or false if not
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getUserById($id){
        $sql = "SELECT * FROM users WHERE id = $id";
        $user = $this->conn->query($sql);
        return $user->fetch_assoc();
    }

    public function getTransactionsById($id, $limit = 3){
        $sql = "SELECT * FROM transactions WHERE user_id = $id ORDER BY transaction_date ASC LIMIT $limit";
        $transactions = $this->conn->query($sql);
        return $transactions;
    }

    public function getCurrentBalanceById($id){
        $income = $this->getTotalIncomeById($id);
        $expense = $this->getTotalExpensesById($id);
        return number_format($income['total_income'] - $expense['total_expenses'], 2, '.', '');
    }

    public function getTotalIncomeById($id){
        $sql = "SELECT COALESCE(SUM(amount), 0) AS total_income FROM transactions WHERE user_id = $id AND transaction_type = 'income'";
        $totalIncome = $this->conn->query($sql);
        return $totalIncome->fetch_assoc();
    }

    public function getTotalExpensesById($id){
        $sql = "SELECT COALESCE(SUM(amount), 0) AS total_expenses FROM transactions WHERE user_id = $id AND transaction_type = 'expense'";
        $totalExpenses = $this->conn->query($sql);
        return $totalExpenses->fetch_assoc();
    }

    public function getTopExpenseCategoriesById($id){
        $sql = "SELECT category, COALESCE(SUM(amount), 0) AS total_amount FROM transactions WHERE user_id = $id AND transaction_type = 'expense' GROUP BY category ORDER BY total_amount DESC LIMIT 5";
        $topCategories = $this->conn->query($sql);
        return $topCategories;
    }

    public function getGoalsById($id){
        $sql = "SELECT * FROM savings_goals WHERE user_id = $id";
        $goals = $this->conn->query($sql);
        return $goals;
    }
    // CREATE TABLE transactions (
    // transaction_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // user_id INT(11) NOT NULL,
    // transaction_type ENUM('income', 'expense') NOT NULL,
    // amount DECIMAL(10, 2) NOT NULL CHECK (amount >= 0),
    // category VARCHAR(50) NOT NULL,
    // description TEXT,
    // transaction_date DATE NOT NULL,
    // created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    // updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    // FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    // );

    // CREATE TABLE savings_goals (
    // goal_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    // user_id INT(11) NOT NULL,
    // goal_name VARCHAR(100) NOT NULL,
    // target_amount DECIMAL(10, 2) NOT NULL CHECK (target_amount >= 0),
    // current_amount DECIMAL(10, 2) DEFAULT 0 CHECK (current_amount >= 0),
    // goal_deadline DATE NOT NULL,
    // created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    // updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    // FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    // );

    public function addTransaction($id, $amount, $type, $category, $description, $date){
        $sql = "INSERT INTO transactions (user_id, transaction_type, amount, category, description, transaction_date) VALUES ($id, '$type', '$amount', '$category', '$description', '$date')";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function addGoal($id, $goalName, $targetAmount, $targetDate){
        $sql = "INSERT INTO savings_goals (user_id, goal_name, target_amount, goal_deadline) VALUES ($id, '$goalName', '$targetAmount', '$targetDate')";
        $result = $this->conn->query($sql);
        return $result;
    }
}