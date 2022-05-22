<?php
include 'login.php';
class endereco extends login {
    private $codEndereco;
    private $cep;
    private $endereco;
    private $numero;
    private $complemento;
    private $cidade;
    private $estado;

    public function getCodEndereco() {
        return $this->codEndereco;
    }

    public function setCodEndereco($codEndereco) {
        $this->codEndereco = $codEndereco;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
    // contrutor setado vazio
    public function __construct() {
        $this->codEndereco = 0;
        $this->cep = "";
        $this->endereco = "";
        $this->numero = "";
        $this->complemento = "";
        $this->cidade = "";
        $this->estado = "";
    }
    
    // método cadastrar endereço
    public function cadastrarEndereco() {
        // abrir conexão em services connection.php
        require_once '../services/connection.php';
        // inserir no banco usando prepare
        $sql = "INSERT INTO endereco (cep, endereco, numero, complemento, cidade, estado) 
                              VALUES (:cep, :endereco, :numero, :complemento, :cidade, :estado)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":complemento", $this->complemento);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->execute();
        $this->setCodEndereco($conn->lastInsertId());
    }
}