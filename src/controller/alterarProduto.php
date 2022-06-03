<?php

include '../model/produto.php';
$produto = new produto();
$produto->setCodProduto($_POST['codProduto']);
$produto->setTipo($_POST['tipo']);
$produto->setModelo($_POST['modelo']);
$produto->setFuncionando(isset($_POST['funcionandoSim']) ? "Sim" : "Não");
$produto->setTempoUso($_POST['tempoUso']);
$produto->setEspecificacoes($_POST['descritivo']);
$produto->atualizarProduto();
echo '<script>alert("Produto Atualizado com sucesso!");</script>';
echo '<script>location.href="../view/home.php";</script>';
