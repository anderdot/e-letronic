<?php
include("../model/empresa.php");
// start a session
session_start();
$logado = unserialize($_SESSION['logado']);
$produto = new produto();
$produto->deletarProdutoPorCodEmpresa($logado->getCodEmpresa());
$logado->excluirLogin();
$logado->excluirEndereco();
$logado->excluirEmpresa();
unset($_SESSION['logado']);
session_destroy();
echo '<script>alert("Empresa excluído com sucesso!");</script>';
echo '<script>location.href="../view/index.html";</script>';