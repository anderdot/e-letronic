<?php
include("../model/cliente.php");
include("../model/produto.php");
session_start();
$logado = unserialize($_SESSION['logado']);
$produto = new produto();
$produto->excluirProdutoPorCodCliente($logado->getCodCliente());
$logado->excluirLogin();
$logado->excluirEndereco();
$logado->excluirCliente();
unset($_SESSION['logado']);
session_destroy();
echo '<script>alert("Cliente excluído com sucesso!");</script>';
echo '<script>location.href="../view/index.html";</script>';