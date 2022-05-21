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

// testar conexão com o banco
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}