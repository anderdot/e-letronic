<?php
include("../model/produto.php");
$produto = new produto();
$produto->excluirProduto();
echo '<script>alert("Produto excluído com sucesso!");</script>';
echo '<script>location.href="../view/home.php";</script>';
