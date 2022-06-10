<?php
class produto
{
    private $codProduto;
    private $tipo;
    private $modelo;
    private $image;
    private $funcionando;
    private $tempoUso;
    private $especificacoes;
    private $cashback;
    private $alterado;
    private $codStatus;
    private $nomeStatus;

    public function getCodProduto()
    {
        return $this->codProduto;
    }

    public function setCodProduto($codProduto)
    {
        $this->codProduto = $codProduto;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getFuncionando()
    {
        return $this->funcionando;
    }

    public function setFuncionando($funcionando)
    {
        $this->funcionando = $funcionando;
    }

    public function getTempoUso()
    {
        return $this->tempoUso;
    }

    public function setTempoUso($tempoUso)
    {
        $this->tempoUso = $tempoUso;
    }

    public function getEspecificacoes()
    {
        return $this->especificacoes;
    }

    public function setEspecificacoes($especificacoes)
    {
        $this->especificacoes = $especificacoes;
    }

    public function getCodStatus()
    {
        return $this->codStatus;
    }

    public function setCodStatus($codStatus)
    {
        $this->codStatus = $codStatus;
    }

    public function getCashback()
    {
        return $this->cashback;
    }

    public function setCashback($cashback)
    {
        $this->cashback = $cashback;
    }

    public function getAlterado()
    {
        return $this->alterado;
    }

    public function setAlterado($alterado)
    {
        $this->alterado = $alterado;
    }

    public function setNomeStatus($nomeStatus)
    {
        $this->nomeStatus = $nomeStatus;
    }

    public function getNomeStatus()
    {
        return $this->nomeStatus;
    }

    public function __construct()
    {
        $this->codProduto = 0;
        $this->tipo = "";
        $this->modelo = "";
        $this->image = "em progresso";
        $this->funcionando = "Sim";
        $this->tempoUso = "";
        $this->especificacoes = "";
        $this->codStatus = "1";
        $this->nomeStatus = "Envio pendente";
    }

    public function cadastrarProduto()
    {
        require '../services/connection.php';
        $sql = "INSERT INTO produto (tipo, modelo, imagem, funcionando, tempoUso, especificacoes, codStatus) 
                             VALUES (:tipo, :modelo, :imagem, :funcionando, :tempoUso, :especificacoes, :codStatus)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':tipo', $this->tipo);
        $stmt->bindValue(':modelo', $this->modelo);
        $stmt->bindValue(':imagem', $this->image);
        $stmt->bindValue(':funcionando', $this->funcionando);
        $stmt->bindValue(':tempoUso', $this->tempoUso);
        $stmt->bindValue(':especificacoes', $this->especificacoes);
        $stmt->bindValue(':codStatus', $this->codStatus);
        $stmt->execute();
        $this->setCodProduto($conn->lastInsertId());
    }

    public function selecionarPorCod()
    {
        require '../services/connection.php';
        $sql = "SELECT * FROM produto AS p JOIN produtoStatus AS s ON p.codStatus = s.codStatus WHERE codProduto = :codProduto";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codProduto', $this->codProduto);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->setCodProduto($result['codProduto']);
        $this->setTipo($result['tipo']);
        $this->setModelo($result['modelo']);
        $this->setImage($result['imagem']);
        $this->setFuncionando($result['funcionando']);
        $this->setTempoUso($result['tempoUso']);
        $this->setEspecificacoes($result['especificacoes']);
        $this->setCashback($result['cashback']);
        $this->setAlterado($result['alterado']);
        $this->setCodStatus($result['codStatus']);
        $this->setNomeStatus($result['nomeStatus']);
    }

    public function selecionarPorCodCliente($codCliente)
    {
        require '../services/connection.php';
        $sql = "SELECT * FROM produto AS p JOIN clienteProduto AS cp ON p.codProduto = cp.codProduto WHERE cp.codCliente = :codCliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codCliente', $codCliente);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selecionarPorCodEmpresa($codEmpresa)
    {
        require '../services/connection.php';
        $sql = "SELECT * FROM produto AS p JOIN empresaProduto AS ep ON p.codProduto = ep.codProduto WHERE ep.codEmpresa = :codEmpresa";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codEmpresa', $codEmpresa);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selecionarPorUltimaAtualizacao($codCliente)
    {
        require '../services/connection.php';
        $sql = "SELECT MAX(alterado) AS alterado, nomeStatus, cashback FROM produto AS p INNER JOIN produtoStatus AS s ON p.codStatus = s.codStatus 
                JOIN clienteProduto AS c ON p.codProduto = c.codProduto WHERE c.codCliente = :codCliente GROUP BY nomeStatus, cashback";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codCliente', $codCliente);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function atualizarProduto()
    {
        require '../services/connection.php';
        $sql = "UPDATE produto SET tipo = :tipo, modelo = :modelo, imagem = :imagem, funcionando = :funcionando, tempoUso = :tempoUso, especificacoes = :especificacoes, codStatus = :codStatus WHERE codProduto = :codProduto";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':tipo', $this->tipo);
        $stmt->bindValue(':modelo', $this->modelo);
        $stmt->bindValue(':imagem', $this->image);
        $stmt->bindValue(':funcionando', $this->funcionando);
        $stmt->bindValue(':tempoUso', $this->tempoUso);
        $stmt->bindValue(':especificacoes', $this->especificacoes);
        $stmt->bindValue(':codStatus', $this->codStatus);
        $stmt->bindValue(':codProduto', $this->codProduto);
        $stmt->execute();
    }

    public function excluirProduto()
    {
        require '../services/connection.php';
        $sql = "DELETE FROM clienteProduto WHERE codProduto = :codProduto";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codProduto', $this->codProduto);
        $stmt->execute();

        $sql = "DELETE FROM empresaProduto WHERE codProduto = :codProduto";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codProduto', $this->codProduto);
        $stmt->execute();

        $sql = "DELETE FROM produto WHERE codProduto = :codProduto";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codProduto', $this->codProduto);
        $stmt->execute();
    }

    public function excluirProdutoPorCodCliente($codCliente)
    {
        require '../services/connection.php';
        $sql = "DELETE FROM clienteProduto WHERE codCliente = :codCliente";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codProduto', $codCliente);
        $stmt->execute();
    }

    public function excluirProdutoPorCodEmpresa($codEmpresa)
    {
        require '../services/connection.php';
        $sql = "DELETE FROM empresaProduto WHERE codEmpresa = :codEmpresa";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':codEmpresa', $codEmpresa);
        $stmt->execute();
    }
}
