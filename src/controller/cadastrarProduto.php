<?php

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        echo '<script>alert("Preencha todos os campos!");</script>';
        echo '<script>location.href="../view/cadastro-produto.html";</script>';
    }
}

include '../model/produto.php';
$produto = new produto();
$produto->setTipo($_POST['tipo']);
$produto->setModelo($_POST['modelo']);
$produto->setFuncionando(isset($_POST['funcionandoSim']) ? "Sim" : "Não");
$produto->setTempoUso($_POST['tempoUso']);
$produto->setEspecificacoes($_POST['descritivo']);
$produto->cadastrarProduto();
echo '<script>alert("Produto inserido com sucesso!");</script>';
echo '<script>location.href="../view/home.php";</script>';
