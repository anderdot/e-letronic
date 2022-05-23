<?php
class login {
    protected $codLogin;
    protected $email;
    protected $senha;

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
        $this->codLogin = 0;
        $this->email = "";
        $this->senha = "";
    }

    public function selectEmail() {
        // abrir conexão em services connection.php
        require '../services/connection.php';

        $sql = "SELECT email FROM login WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function cadastrarlogin() {
        // abrir conexão em services connection.php
        require '../services/connection.php';

        // inserir no banco usando prepared statement
        $sql = "INSERT INTO login (email, senha) VALUES (:email, :senha)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->execute();
        $this->setCodLogin($conn->lastInsertId());
        // echo "Login cadastrado com sucesso! " . $this->getCodLogin() . "<br>";
    }
}