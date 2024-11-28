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
        $filter = $_GET['filter'] ?? 'month'; // Default filter is 'month'
        $startDate = $_GET['start_date'] ?? null;
        $endDate = $_GET['end_date'] ?? null;
    
        // Validate dates if the 'custom' filter is selected
        if ($filter === 'custom') {
            $dateFormat = 'Y-m-d'; // Expected date format
            $errors = [];
    
            // Check if start_date is not empty and is a valid date
            if (!empty($startDate) && \DateTime::createFromFormat($dateFormat, $startDate) === false) {
                $errors[] = 'Start date is not in a valid format.';
            }
    
            // Check if end_date is not empty and is a valid date
            if (!empty($endDate) && \DateTime::createFromFormat($dateFormat, $endDate) === false) {
                $errors[] = 'End date is not in a valid format.';
            }
    
            // Ensure that start_date is less than or equal to end_date
            if (!empty($startDate) && !empty($endDate) && $startDate > $endDate) {
                $errors[] = 'Start date must be less than or equal to end date.';
            }
    
            // If there are errors, reset the filter to default and handle error messages
            if (!empty($errors)) {
                $filter = 'month'; // Reset to default filter
                $errorMsg = implode(' ', $errors); // Create a message from the errors
                // Handle error message (e.g., set flash message to display in the view)
            }
        }
    
        // Adjust the query based on the filter
        $transactions = $this->user->getTransactionsById($id, 'ASC', 30, $filter, $startDate, $endDate);
        $income = $this->user->getTotalIncomeById($id, $filter, $startDate, $endDate);
        $expenses = $this->user->getTotalExpensesById($id, $filter, $startDate, $endDate);
        $goals = $this->user->getGoalsById($id); // Assuming goals aren't time-filtered
        $topCategories = $this->user->getTopExpenseCategoriesById($id, $filter, $startDate, $endDate);
        // $topCategories = $this->user->getTopExpenseCategoriesById($id);
        // Include any error message in the view
        require_once __DIR__ . '/../../src/View/reports.php';
    }
    
}