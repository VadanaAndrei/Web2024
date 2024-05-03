<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pgsql = require __DIR__ . '/connect.php';

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pgsql->prepare($sql);

    $stmt->bindParam(':email', $_POST['e-mail']);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {

            session_start();

            session_regenerate_id();

            $_SESSION['user_id'] = $user['user_id'];
            header('Location:../html-pages/profile.html');
            exit;

        } else {
            die('Invalid password');
        }
    } else {
        die('User not found');
    }
}
?>
