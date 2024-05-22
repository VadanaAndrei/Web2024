<?php
header('Content-Type: application/json');

try {
    require __DIR__ . "/../app/db/connect.php";

    $users = [];
    $reports = [];

    $sql_users = "SELECT user_id, username, email FROM users";
    $result_users = $mysqli->query($sql_users);
    if ($result_users->num_rows > 0) {
        while ($row = $result_users->fetch_assoc()) {
            $users[] = $row;
        }
    }

    $sql_reports = "SELECT report_id, species, area FROM reports";
    $result_reports = $mysqli->query($sql_reports);
    if ($result_reports->num_rows > 0) {
        while ($row = $result_reports->fetch_assoc()) {
            $reports[] = $row;
        }
    }

    $mysqli->close();

    echo json_encode(['users' => $users, 'reports' => $reports]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
