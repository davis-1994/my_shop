<?php

if (!isset($_SESSION)) {
    session_start();
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "mans_veikals";

try {
    $pdo = new PDO("mysql:host=$servername;port=3406;dbname=$db_name", $db_username, $db_password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
