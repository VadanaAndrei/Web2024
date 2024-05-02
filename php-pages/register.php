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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $email = !empty($_POST['e-mail']) ? trim($_POST['e-mail']) : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;
    $confirm_password = !empty($_POST['confirm-password']) ? $_POST['confirm-password'] : null;

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $pgsql = require __DIR__ . '/connect.php';

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pgsql->prepare($sql);

        if ($stmt === false) {
            throw new Exception("SQL error: " . $pgsql->errorInfo()[2]);
        }

        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $password_hash, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            throw new Exception("Execution error: " . $stmt->errorInfo()[2]);
        }

        header('Location:../html-pages/index.html');  //de facut o trimitere spre o alta pagina
        exit;
    } catch (PDOException $e) {
        $errorInfo = $e->errorInfo;
        if ($errorInfo[0] == '23505') {
            die("Username or email already exists. Please try a different one.");
        } else {
            die($e->getMessage());
        }
    }
}

