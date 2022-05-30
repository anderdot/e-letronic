<?php
include("../model/cliente.php");
// start a session
session_start();
$logado = unserialize($_SESSION['logado']);
$logado->excluirLogin();
$logado->excluirEndereco();
$logado->excluirCliente();
unset($_SESSION['logado']);
session_destroy();
echo '<script>alert("Cliente excluído com sucesso!");</script>';
echo '<script>location.href="../view/index.html";</script>';