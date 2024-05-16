<?php

class ChangePassword extends Controller{
    public function index(){
        $this -> view('change-password');
    }

    public function changePassword()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            die("You need to be authenticated to access this page.");
        }

        $userId = $_SESSION['user_id'];

        $mysqli = require __DIR__ . '/../db/connect.php';

        $oldPassword = $_POST['password'];
        $newPassword = $_POST['new-password'];
        $confirmNewPassword = $_POST['confirm-password'];

        $sql = "SELECT password FROM users WHERE user_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user === null) {
            die("No user with this id.");
        }

        if (!password_verify($oldPassword, $user['password'])) {
            die("Old password is incorrect.");
        }

        if (strlen($newPassword) < 8) {
            die('Password must be at least 8 characters long');
        }

        if (!preg_match("/[a-z]/i", $newPassword)) {
            die('Password must contain at least one letter');
        }

        if (!preg_match("/[0-9]/", $newPassword)) {
            die('Password must contain at least one digit');
        }

        if ($newPassword !== $confirmNewPassword) {
            die('Passwords do not match');
        }

        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password = ? WHERE user_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si', $newPasswordHash, $userId);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            die("There weren't any changes in database.");
        }

        header("Location: ../Profile?password_changed=true");
        exit;
    }
}