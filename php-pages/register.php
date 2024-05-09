<?php

if (empty($_POST['e-mail'])) {
    die('Email is required');
}

if (!filter_var(trim($_POST['e-mail']), FILTER_VALIDATE_EMAIL)) {
    die('Valid email is required');
}

if (strlen($_POST['password']) < 8) {
    die('Password must be at least 8 characters long');
}

if (!preg_match('/[a-z]/i', $_POST['password'])) {
    die('Password must contain at least one letter');
}

if (!preg_match('/[0-9]/', $_POST['password'])) {
    die('Password must contain at least one digit');
}

if ($_POST['password'] !== $_POST['confirm-password']) {
    die('Passwords do not match');
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connect.php";

$sql = "INSERT INTO users (username, email, password)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["username"],
                  $_POST["e-mail"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: ../html-pages/login-register.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

