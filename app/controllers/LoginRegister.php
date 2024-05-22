<?php

class LoginRegister extends Controller{
    public function index(){
        $this -> view('login-register');
    }

    public function register()
    {
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

        $mysqli = require __DIR__ . "/../db/connect.php";

        $sql = "INSERT INTO users (username, email, password)
        VALUES (?, ?, ?)";

        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param(
            "sss",
            $_POST["username"],
            $_POST["e-mail"],
            $password_hash
        );

        if ($stmt->execute()) {
            header("Location: ../LoginRegister");
            exit;
        } else {
            if ($mysqli->errno === 1062) {
                $error = $mysqli->error;
                if (strpos($error, 'username') !== false) {
                    die("Username already taken");
                } elseif (strpos($error, 'email') !== false) {
                    die("Email already taken");
                } else {
                    die("Duplicate entry");
                }
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        }
    }

    public function authenticateUser() {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $mysqli = require __DIR__ . "/../db/connect.php";

            $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $_POST["e-mail"]);
            $stmt->execute();
            $result = $stmt->get_result();

            $user = $result->fetch_assoc();

            if ($user && password_verify($_POST["password"], $user["password"])) {
                session_regenerate_id();
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["user_type"] = 'user';
                header("Location: ../Profile");
                exit;
            } else {
                $_SESSION['error_message'] = "Invalid credentials";
                header("Location: ../LoginRegister");
                exit;
            }
        }
    }


    public function logout() {
        session_start();
        session_destroy();
        header("Location: ../LoginRegister");
        exit;
    }

    public function authenticateAdmin() {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $mysqli = require __DIR__ . "/../db/connect.php";

            $stmt = $mysqli->prepare("SELECT * FROM admin WHERE username = ?");
            $stmt->bind_param("s", $_POST["username-admin"]);
            $stmt->execute();
            $result = $stmt->get_result();

            $admin = $result->fetch_assoc();

            if ($admin && password_verify($_POST["password-admin"], $admin["password"])) {
                session_regenerate_id();
                $_SESSION["user_id"] = $admin["admin_id"];
                $_SESSION["user_type"] = 'admin';
                header("Location: ../AdminProfile");
                exit;
            } else {
                header("Location: ../LoginRegister");
                exit;
            }
        }
    }
}