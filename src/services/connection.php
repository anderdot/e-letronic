<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eletronic";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    return $conn;
} catch (PDOException $e) {
    throw new PDOException($e);
}
