<?php
class login
{
    protected $codLogin;
    protected $email;
    protected $senha;
    protected $tipo;

    public function getCodLogin()
    {
        return $this->codLogin;
    }

    public function setCodLogin($codLogin)
    {
        $this->codLogin = $codLogin;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = md5($senha);
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function __construct()
    {
        $this->codLogin = 0;
        $this->email = "";
        $this->senha = "";
        $this->tipo = "";
    }

    public function cadastrarlogin()
    {
        require '../services/connection.php';
        $sql = "INSERT INTO login (email, senha, tipo) VALUES (:email, :senha, :tipo)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->execute();
        $this->setCodLogin($conn->lastInsertId());
    }

    public function selecionarEmail()
    {
        require '../services/connection.php';

        $sql = "SELECT email FROM login WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selecionarLoginPorEmailSenha()
    {
        require '../services/connection.php';
        $sql = "SELECT * FROM login WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":senha", $this->senha);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function alterarLogin()
    {
        require '../services/connection.php';

        $sql = "UPDATE login SET email = :email, senha = :senha WHERE codLogin = :codLogin";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":codLogin", $this->codLogin);
        $stmt->execute();
    }

    public function excluirLogin()
    {
        require '../services/connection.php';
        $sql = "DELETE FROM login WHERE codLogin = :codLogin";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":codLogin", $this->codLogin);
        $stmt->execute();
    }
}
