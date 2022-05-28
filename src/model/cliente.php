<?php
require_once 'endereco.php';
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
        $this->nome = trim($nome);
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = trim($sobrenome);
    }

    public function getDataNascimento() {
        return implode('/', array_reverse(explode('-', $this->dataNascimento)));
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = implode('-', array_reverse(explode('/', $dataNascimento)));
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = preg_replace('/[^0-9]/', '', $cpf);
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = preg_replace('/[^0-9]/', '', $telefone);
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

    public function selecionarPorCod() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "SELECT * FROM `cliente` AS C
            INNER JOIN `endereco` AS E
            ON C.codEndereco = E.codEndereco
            INNER JOIN `login` AS L
            ON C.codLogin = L.codLogin 
            WHERE codCliente = :codCliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":codCliente", $this->codCliente);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selecionarPorEmailSenha() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "SELECT * FROM `cliente` AS C
            INNER JOIN `endereco` AS E
            ON C.codEndereco = E.codEndereco
            INNER JOIN `login` AS L
            ON C.codLogin = L.codLogin 
            WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":senha", $this->senha);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->setCodCliente($result['codCliente']);
        $this->setNome($result['nome']);
        $this->setSobrenome($result['sobrenome']);
        $this->setDataNascimento($result['dataNascimento']);
        $this->setCpf($result['cpf']);
        $this->setTelefone($result['telefone']);

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

    public function atualizar() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "UPDATE cliente SET nome = :nome, sobrenome = :sobrenome, dataNascimento = :dataNascimento, cpf = :cpf, telefone = :telefone, 
                                   codEndereco = :codEndereco, codLogin = :codLogin WHERE codCliente = :codCliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":sobrenome", $this->sobrenome);
        $stmt->bindParam(":dataNascimento", $this->dataNascimento);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":codEndereco", $this->codEndereco);
        $stmt->bindParam(":codLogin", $this->codLogin);
        $stmt->bindParam(":codCliente", $this->codCliente);
        $stmt->execute();
        // echo "Cliente atualizado com sucesso! Código: " . $this->getCodCliente() . "<br>";
    }

    public function excluir() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "DELETE FROM cliente WHERE codCliente = :codCliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":codCliente", $this->codCliente);
        $stmt->execute();
        // echo "Cliente deletado com sucesso! Código: " . $this->getCodCliente() . "<br>";
    }
}