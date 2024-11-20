<?php

namespace App\Controller;

use App\Model\User;

class AuthController {
    private $conn;
    private $userModel;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->userModel = new User($conn);
    }

    public function login() {
        require_once __DIR__ . '/../../src/View/login.php';
    }

    public function signup() {
        require_once __DIR__ . '/../../src/View/signup.php';
    }

    public function loginSubmit() {
        $user = $this->userModel->login(htmlspecialchars($_POST['username']));
        if($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            header('Location: /dashboard');
        } else {
            echo 'Invalid username or password';
        }
    }

    public function signupSubmit() {
        $result = $this->userModel->signup($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['username'], $_POST['password']);
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

