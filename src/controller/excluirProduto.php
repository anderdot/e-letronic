<?php
include("../model/produto.php");
// start a session
$produto = new produto();
$produto->excluirProduto();
echo '<script>alert("Produto excluído com sucesso!");</script>';
echo '<script>location.href="../view/home.php";</script>';