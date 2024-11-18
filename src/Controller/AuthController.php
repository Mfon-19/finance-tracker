<?php

namespace App\Controller;

use App\Model\User;

class AuthController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login() {
        require_once __DIR__ . '/../../src/View/login.php';
    }

    public function signup() {
        require_once __DIR__ . '/../../src/View/signup.php';
    }

    public function loginSubmit() {
        $userModel = new User($this->conn);
        $user = $userModel->login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
        if($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            header('Location: /dashboard');
        } else {
            echo 'Invalid username or password';
        }
    }

    public function signupSubmit() {
        $userModel = new User($this->conn);
        $result = $userModel->signup($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['username'], $_POST['password']);
        if($result) {
            header('Location: /dashboard');
        } else {
            echo 'Error signing up';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /');
    }
}

