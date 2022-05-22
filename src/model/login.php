<?php
class login {
    private $codLogin;
    private $email;
    private $senha;

    public function getCodLogin() {
        return $this->codLogin;
    }

    public function setCodLogin($codLogin) {
        $this->codLogin = $codLogin;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function __construct() {
        $this->codLogin = "";
        $this->email = "";
        $this->senha = "";
    }

    // função para fazer select por email
    public function selectEmail() {
        // abrir conexão em services connection.php
        require_once '../services/connection.php';

        $sql = "SELECT * FROM login WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // função cadastrar login
    public function cadastrarlogin() {
        // abrir conexão em services connection.php
        require_once '../services/connection.php';
        // inserir no banco usando prepared statement
        $sql = "INSERT INTO login (email, senha) VALUES (:email, :senha)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        print_r($stmt);
        $stmt->execute();
        $this->setCodLogin($conn->lastInsertId());
        print_r($this->codLogin);
    }
}