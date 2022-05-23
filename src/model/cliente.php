<?php
include 'endereco.php';
class cliente extends endereco {
    private $codCliente;
    private $nome;
    private $sobrenome;
    private $dataNascimento;
    private $cpf;
    private $telefone;

    public function getCodCliente() {
        return $this->codCliente;
    }

    public function setCodCliente($codCliente) {
        $this->codCliente = $codCliente;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    // construtor vazio
    public function __construct() {
        $this->codCliente = 0;
        $this->nome = "";
        $this->sobrenome = "";
        $this->dataNascimento = "";
        $this->cpf = "";
        $this->telefone = "";
    }

    public function cadastrarCliente() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "INSERT INTO cliente (nome, sobrenome, dataNascimento, cpf, telefone, codEndereco, codLogin) 
                             VALUES (:nome, :sobrenome, :dataNascimento, :cpf, :telefone, :codEndereco, :codLogin)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":sobrenome", $this->sobrenome);
        $stmt->bindParam(":dataNascimento", $this->dataNascimento);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":codEndereco", $this->codEndereco);
        $stmt->bindParam(":codLogin", $this->codLogin);
        $stmt->execute();
        $this->setCodCliente($conn->lastInsertId());
        // echo "Cliente cadastrado com sucesso! Código: " . $this->getCodCliente() . "<br>";
    }
}