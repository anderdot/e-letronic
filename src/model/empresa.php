<?php
require_once 'endereco.php';
class empresa extends endereco {
    private $codEmpresa;
    private $razaoSocial;
    private $telefone;
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
        $this->razaoSocial = trim($razaoSocial);
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = preg_replace('/[^0-9]/', '', $telefone);
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    }

    public function getIe() {
        return $this->ie;
    }

    public function setIe($ie) {
        $this->ie = preg_replace('/[^0-9]/', '', $ie);
    }

    // construtor vazio
    public function __construct() {
        $this->codEmpresa = 0;
        $this->razaoSocial = "";
        $this->telefone = "";
        $this->cnpj = "";
        $this->ie = "";
    }

    public function cadastrarEmpresa() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "INSERT INTO empresa (razaoSocial, telefone, cnpj, ie, codEndereco, codLogin) 
                             VALUES (:razaoSocial, :telefone, :cnpj, :ie, :codEndereco, :codLogin)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':razaoSocial', $this->razaoSocial);
        $stmt->bindValue(':telefone', $this->telefone);
        $stmt->bindValue(':cnpj', $this->cnpj);
        $stmt->bindValue(':ie', $this->ie);
        $stmt->bindValue(':codEndereco', $this->codEndereco);
        $stmt->bindValue(':codLogin', $this->codLogin);
        $stmt->execute();
        $this->setCodEmpresa($conn->lastInsertId());
        // echo "Empresa cadastrada com sucesso! Codigo: " . $this->getCodEmpresa() . "<br>";
    }

    public function selecionarPorCod() {
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

    public function selecionarPorEmailSenha() {
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
        // setar na classe
        $this->setCodEmpresa($result['codEmpresa']);
        $this->setRazaoSocial($result['razaoSocial']);
        $this->setTelefone($result['telefone']);
        $this->setCnpj($result['cnpj']);
        $this->setIe($result['ie']);

        $this->setCodEndereco($result['codEndereco']);
        $this->setCep($result['cep']);
        $this->setEndereco($result['endereco']);
        $this->setNumero($result['numero']);
        $this->setComplemento($result['complemento']);
        $this->setCidade($result['cidade']);
        $this->setEstado($result['estado']);

        $this->setCodLogin($result['codLogin']);
        $this->setEmail($result['email']);
        $this->setSenha($result['senha']);
        $this->setTipo($result['tipo']);
    }

    public function alterarEmpresa() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "UPDATE empresa SET razaoSocial = :razaoSocial, telefone = :telefone, cnpj = :cnpj, ie = :ie, 
                                   codEndereco = :codEndereco, codLogin = :codLogin WHERE codEmpresa = :codEmpresa";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':razaoSocial', $this->razaoSocial);
        $stmt->bindValue(':telefone', $this->telefone);
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