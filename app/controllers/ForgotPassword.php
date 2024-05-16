<?php

class ForgotPassword extends Controller{
    public function index(){
        $this -> view('forgot-password');
    }

    public function sendPassword()
    {
        $email = $_POST["e-mail"];

        $token = bin2hex(random_bytes(16));

        $token_hash = hash("sha256", $token);

        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        $mysqli = require __DIR__ . "/../db/connect.php";

        $sql = "UPDATE users
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("sss", $token_hash, $expiry, $email);

        $stmt->execute();

        if ($mysqli->affected_rows > 0) {
            $to = $email;
            $subject = "Reset Your Password";
            $message = "<html><body>";
            $message .= "You have requested to reset your password. Please ";
            $message .= "<a href='http://localhost/Web2024/public/ForgotPassword/resetPassword?token=$token'>click here</a>";
            $message .= " to reset your password.";
            $message .= "</body></html>";
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "From: FePA";

            if (mail($to, $subject, $message, $headers)) {
                echo "Email Sent Successfully";
            } else {
                echo "Email failed";
            }
        }
    }

    public function resetPassword()
    {
        $token = $_GET["token"];

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

        header("Location: ../NewPassword?token=$token");
    }
}