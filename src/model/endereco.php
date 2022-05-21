<?php
class endereco {
    private $codEndereco;
    private $cep;
    private $endereco;
    private $numero;
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

    public function __construct($codEndereco, $cep, $endereco, $numero, $cidade, $estado) {
        $this->codEndereco = $codEndereco;
        $this->cep = $cep;
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }
}