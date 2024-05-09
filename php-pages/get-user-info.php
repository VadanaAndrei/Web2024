<?php
session_start();

require __DIR__ . '/connect.php';

$response = []; 

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT username, email FROM users WHERE user_id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('i', $user_id); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $response['username'] = $row['username'];
            $response['email'] = $row['email'];
        }
        $stmt->close();
    } else {
        echo "Database error: " . $mysqli->error;
        exit;
    }
}

echo json_encode($response);
?>
