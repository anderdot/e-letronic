<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eletronic";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    $conn = null;
}
