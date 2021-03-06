<?php
require_once 'login.php';
class endereco extends login {
    protected $codEndereco;
    protected $cep;
    protected $endereco;
    protected $numero;
    protected $complemento;
    protected $cidade;
    protected $estado;

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
        $this->cep = preg_replace('/[^0-9]/', '', $cep);
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
        require '../services/connection.php';
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
        // echo "Endereço cadastrado com sucesso! " . $this->getCodEndereco() . "<br>";
    }

    public function alterarEndereco() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "UPDATE endereco SET cep = :cep, endereco = :endereco, numero = :numero, complemento = :complemento, 
                                    cidade = :cidade, estado = :estado WHERE codEndereco = :codEndereco";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":complemento", $this->complemento);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":codEndereco", $this->codEndereco);
        $stmt->execute();
        // echo "Endereço alterado com sucesso! " . $this->getCodEndereco() . "<br>";
    }

    public function excluirEndereco() {
        // abrir conexão em services connection.php
        require '../services/connection.php';
        $sql = "DELETE FROM endereco WHERE codEndereco = :codEndereco";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":codEndereco", $this->codEndereco);
        $stmt->execute();
        // echo "Endereço excluído com sucesso! " . $this->getCodEndereco() . "<br>";
    }
}