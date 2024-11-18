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
    $controller = new \App\Controller\DashboardController($conn);
    $controller->index();
});

$router->map('GET', '/reports', function() use ($conn) {
    $controller = new \App\Controller\ReportsController($conn);
    $controller->index();
});

$router->map('GET', '/logout', function() use ($conn) {
    $controller = new \App\Controller\AuthController($conn);
    $controller->logout();
});

$match = $router->match();

if($match) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo '404 Not found';
}
