<?php 
    session_start();
    header('Location: dashboard.php');
    exit();

    // include "db_connect.php";

    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     $username = htmlspecialchars($_POST['username']);
    //     $password = htmlspecialchars($_POST['password']);

    //     $sql = "SELECT * from users where username = '$username'";
    //     $result = $conn->query($sql);

    //     // if username exists in our database
    //     if($result->num_rows > 0){
    //         // fetch the row associated with the username
    //         $user = $result->fetch_assoc();

    //         // password is a column in our database
    //         if($password === $user['password']){
    //             // echo"Login successful! Welcome, ". $user['first_name'];

    //             $_SESSION['user_id'] = $user['id'];
    //             $_SESSION['username'] = $user['username'];
    //             $_SESSION['first_name'] = $user['first_name'];

    //             header('Location: dashboard.php');
    //             exit();
    //         } else {
    //             echo"Invalid password. Please try again";
    //         }
    //     } else {
    //         echo"No user found with that username";
    //     }
    // }

    // $conn->close();
?>