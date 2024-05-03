<?php
$host = "localhost";  
$port = "5432";       
$dbname = "FePA"; 
$user = "postgres";    
$password = "1234"; 

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    $dbconn = new PDO($dsn);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbconn;
} catch (PDOException $e) {
    echo "Connecting error: " . $e->getMessage();
    exit;
}


?>
