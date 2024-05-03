<?php
session_start();

require __DIR__ . '/connect.php';

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT username, email FROM users WHERE user_id = :id";

    try {
        $stmt = $dbconn->prepare($sql);
        $stmt->execute(['id' => $user_id]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response['username'] = $row['username'];
            $response['email'] = $row['email'];
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit;
    }
}

echo json_encode($response);
?>
