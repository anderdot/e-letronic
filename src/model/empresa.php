<?php
require_once 'endereco.php';
class empresa extends endereco {
    private $codEmpresa;
    private $razaoSocial;
    private $cnpj;
    private $ie;

    public function getCodEmpresa() {
        return $this->codEmpresa;
    }

    public function setCodEmpresa($codEmpresa) {
        $this->codEmpresa = $codEmpresa;
    }

    public function getRazaoSocial() {
        return $this->razaoSocial;
    }

    public function setRazaoSocial($razaoSocial) {
        $this->razaoSocial = $razaoSocial;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getIe() {
        return $this->ie;
    }

    public function setIe($ie) {
        $this->ie = $ie;
    }

    // construtor vazio
    public function __construct() {
        $this->codEmpresa = 0;
        $this->razaoSocial = "";
        $this->cnpj = "";
        $this->ie = "";
    }

    public function cadastrarEmpresa() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "INSERT INTO empresa (razaoSocial, cnpj, ie, codEndereco, codLogin) VALUES (:razaoSocial, :cnpj, :ie, :codEndereco, :codLogin)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':razaoSocial', $this->razaoSocial);
        $stmt->bindValue(':cnpj', $this->cnpj);
        $stmt->bindValue(':ie', $this->ie);
        $stmt->bindValue(':codEndereco', $this->codEndereco);
        $stmt->bindValue(':codLogin', $this->codLogin);
        $stmt->execute();
        $this->setCodEmpresa($conn->lastInsertId());
        // echo "Empresa cadastrada com sucesso! Codigo: " . $this->getCodEmpresa() . "<br>";
    }

    public function selecionarEmpresaPorCod() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "SELECT * FROM `empresa` AS M
            INNER JOIN `endereco` AS E
            ON M.codEndereco = E.codEndereco
            INNER JOIN `login` AS L
            ON M.codLogin = L.codLogin 
            WHERE codEmpresa = :codEmpresa";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codEmpresa', $this->codEmpresa);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selecionarEmpresaPorEmailSenha() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "SELECT * FROM `empresa` AS M
            INNER JOIN `endereco` AS E
            ON M.codEndereco = E.codEndereco
            INNER JOIN `login` AS L
            ON M.codLogin = L.codLogin 
            WHERE L.email = :email AND L.senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function alterarEmpresa() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "UPDATE empresa SET razaoSocial = :razaoSocial, cnpj = :cnpj, ie = :ie, codEndereco = :codEndereco, codLogin = :codLogin WHERE codEmpresa = :codEmpresa";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':razaoSocial', $this->razaoSocial);
        $stmt->bindValue(':cnpj', $this->cnpj);
        $stmt->bindValue(':ie', $this->ie);
        $stmt->bindValue(':codEndereco', $this->codEndereco);
        $stmt->bindValue(':codLogin', $this->codLogin);
        $stmt->bindValue(':codEmpresa', $this->codEmpresa);
        $stmt->execute();
        // echo "Empresa atualizado com sucesso! Código: " . $this->getCodEmpresa() . "<br>";
    }

    public function excluirEmpresa() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "DELETE FROM empresa WHERE codEmpresa = :codEmpresa";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codEmpresa', $this->codEmpresa);
        $stmt->execute();
        // echo "Empresa excluído com sucesso! Código: " . $this->getCodEmpresa() . "<br>";
    }
}