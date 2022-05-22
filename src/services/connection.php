<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eletronic";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    echo "Connected successfully";
    // return $conn;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    throw new PDOException($e);
}
