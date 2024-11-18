<?php

namespace App\Model;

class User {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function login($username, $password){
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $user = $this->conn->query($sql);
        return $user->fetch_assoc();
    }

    public function signup($firstname, $lastname, $email, $phone, $username, $password){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (first_name, last_name, email, phone, username, password) 
        VALUES ('$firstname', '$lastname', '$email', '$phone', '$username', '$hashedPassword')";
        $result = $this->conn->query($sql);
        return $result;
    }
}