<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/connect.php";

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST["e-mail"]);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($user && password_verify($_POST["password"], $user["password"])) {
        session_regenerate_id();
        $_SESSION["user_id"] = $user["user_id"];
        header("Location: ../html-pages/profile.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Invalid credentials";
        header("Location: ../html-pages/login-register.php");
        exit;
    }
}
