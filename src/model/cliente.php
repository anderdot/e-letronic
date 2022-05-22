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
        require_once '../services/connection.php';

        $sql = "INSERT INTO cliente (nome, sobrenome, dataNascimento, cpf, telefone, email, senha) VALUES (:nome, :sobrenome, :dataNascimento, :cpf, :telefone, :email, :senha)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":sobrenome", $this->sobrenome);
        $stmt->bindParam(":dataNascimento", $this->dataNascimento);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        return $stmt->execute();
    }

    public function atualizarCliente() {
        // abrir conexão em services connection.php
        require_once '../services/connection.php';

        $sql = "UPDATE cliente SET nome = :nome, sobrenome = :sobrenome, dataNascimento = :dataNascimento, cpf = :cpf, telefone = :telefone, email = :email, senha = :senha WHERE codCliente = :codCliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":codCliente", $this->codCliente);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":sobrenome", $this->sobrenome);
        $stmt->bindParam(":dataNascimento", $this->dataNascimento);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        return $stmt->execute();
    }

    public function excluirCliente() {
        // abrir conexão em services connection.php
        require_once '../services/connection.php';

        $sql = "DELETE FROM cliente WHERE codCliente = :codCliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":codCliente", $this->codCliente);
        return $stmt->execute();
    }

    public function buscarCliente() {
        // abrir conexão em services connection.php
        require_once '../services/connection.php';

        $sql = "SELECT * FROM cliente WHERE codCliente = :codCliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":codCliente", $this->codCliente);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarClientes() {
        // abrir conexão em services connection.php
        require_once '../services/connection.php';

        $sql = "SELECT * FROM cliente";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}