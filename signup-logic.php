<?php
    session_start();
    $_SESSION['user_id'] = 1;
    header('Location: dashboard.php');
    exit();

    // TODO: Add logic to sign up user
?>