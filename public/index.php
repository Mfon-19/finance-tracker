<?php

require_once './../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';
session_start();

// Initialize router
$router = new AltoRouter();

// Load environment variables
$env = loadEnv(__DIR__ . '/../.env');

try {
    // Create a new mysqli object to connect to the database
    $conn = new mysqli($env['DB_HOST'], $env['DB_USER_NAME'], $env['DB_PASSWORD'], $env['DB_NAME']);
} catch (\Throwable $th) {
    die("Connection failed: {$th->getMessage()}");
}

// Home route
$router->map('GET', '/', function() {
    $controller = new \App\Controller\HomeController();
    $controller->index();
});

// Login route to display the login form
$router->map('GET', '/login', function() use ($conn) {
    $controller = new \App\Controller\AuthController($conn);
    $controller->login();
});

// Login post route to handle form submission
$router->map('POST', '/login', function() use ($conn) {
    $controller = new \App\Controller\AuthController($conn);
    $controller->loginSubmit();
});

// Signup route to display the signup form
$router->map('GET', '/signup', function() use ($conn) {
    $controller = new \App\Controller\AuthController($conn);
    $controller->signup();
});

// Signup post route to handle form submission
$router->map('POST', '/signup', function() use ($conn) {
    $controller = new \App\Controller\AuthController($conn);
    $controller->signupSubmit();
});

// Dashboard route to display the dashboard
$router->map('GET', '/dashboard', function() use ($conn) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit();
    }
    $controller = new \App\Controller\DashboardController($conn);
    $controller->showDashboard($_SESSION['user_id']);
});

$router->map('GET', '/reports', function() use ($conn) {
    $controller = new \App\Controller\ReportsController($conn);
    $controller->showReports($_SESSION['user_id']);
});

$router->map('GET', '/logout', function() use ($conn) {
    $controller = new \App\Controller\AuthController($conn);
    $controller->logout();
});

$router->map('POST', '/add-transaction', function() use ($conn) {
    $controller = new \App\Controller\DashboardController($conn);
    $controller->addTransaction($_SESSION['user_id'], $_POST['amount'], $_POST['type'], $_POST['category'], $_POST['description'], $_POST['date']);
});

$router->map('POST', '/add-goal', function() use ($conn) {
    $controller = new \App\Controller\DashboardController($conn);
    $controller->addGoal($_SESSION['user_id'], $_POST['goalName'], $_POST['targetAmount'], $_POST['targetDate']);
});

$match = $router->match();

if($match) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo '404 Not found';
}