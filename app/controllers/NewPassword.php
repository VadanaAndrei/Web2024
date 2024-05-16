<?php

class NewPassword extends Controller{
    public function index(){
        $this -> view('new-password');
    }

    public function processResetPassword()
    {
        $token = $_POST["token"];

        $token_hash = hash("sha256", $token);

        $mysqli = require __DIR__ . "/../db/connect.php";

        $sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("s", $token_hash);

        $stmt->execute();

        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        if ($user === null) {
            die("token not found");
        }

        if (strtotime($user["reset_token_expires_at"]) <= time()) {
            die("token has expired");
        }

        if (strlen($_POST["password"]) < 8) {
            die("Password must be at least 8 characters");
        }

        if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
            die("Password must contain at least one letter");
        }

        if ( ! preg_match("/[0-9]/", $_POST["password"])) {
            die("Password must contain at least one number");
        }

        if ($_POST["password"] !== $_POST["confirm-password"]) {
            die("Passwords must match");
        }

        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "UPDATE users
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE user_id = ?";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("ss", $password_hash, $user["user_id"]);

        $stmt->execute();

        header("Location: ../LoginRegister");
    }
}