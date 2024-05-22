<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user_id'])) {
    $userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : 'user';
    echo json_encode(['loggedIn' => true, 'user_type' => $userType]);
} else {
    echo json_encode(['loggedIn' => false]);
}
?>