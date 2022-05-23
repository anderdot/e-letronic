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

    public function selecionarEmail() {
        // abrir conexão em services connection.php
        require '../services/connection.php';

        $sql = "SELECT email FROM login WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selecionarLoginPorEmailSenha() {
        // abrir conexão em services connection.php
        require '../services/connection.php';

        $sql = "SELECT * FROM login WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":senha", $this->senha);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function alterarLogin() {
        // abrir conexão em services connection.php
        require '../services/connection.php';

        $sql = "UPDATE login SET email = :email, senha = :senha WHERE codLogin = :codLogin";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":codLogin", $this->codLogin);
        $stmt->execute();
        // echo "Login alterado com sucesso! " . $this->getCodLogin() . "<br>";
    }

    public function excluirLogin() {
        // abrir conexão em services connection.php
        require '../services/connection.php';

        $sql = "DELETE FROM login WHERE codLogin = :codLogin";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":codLogin", $this->codLogin);
        $stmt->execute();
        // echo "Login excluído com sucesso! " . $this->getCodLogin() . "<br>";
    }
}