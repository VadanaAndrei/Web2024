<?php
require __DIR__ . "/connect.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$type = $data['type'];
$value = $data['value'];

$sql = "";
if ($type === 'username') {
    $sql = "SELECT * FROM users WHERE username=?";
} else if ($type === 'email') {
    $sql = "SELECT * FROM users WHERE email=?";
}

if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = array();
    $response['exists'] = $result->num_rows > 0 ? true : false;

    echo json_encode($response);

    $stmt->close();
} else {
    echo json_encode(['error' => 'Database query failed']);
}

$mysqli->close();
?>
