<?php
global $mysqli;
session_start();
require __DIR__ . "/../app/db/connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents('php://input'), true);
    $oldPassword = $input['password'] ?? '';

    $response = ['correct' => false];

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        $stmt = $mysqli->prepare('SELECT password FROM users WHERE user_id = ?');
        if ($stmt) {
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($oldPassword, $user['password'])) {
                $response['correct'] = true;
            }

            $stmt->close();
        }
    }

    echo json_encode($response);
}
?>
