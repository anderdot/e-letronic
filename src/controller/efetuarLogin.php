<?php
// verificar se email e senha são vazios
if (empty($_POST['email']) || empty($_POST['senha'])) {
    echo '<script>alert("Preencha todos os campos!");</script>';
    echo '<script>location.href="../view/entrar.html";</script>';
}

include '../model/login.php';
$login = new login();

$login->setEmail($_POST['email']);
$login->setSenha($_POST['senha']);

// verificar se email e senha existem
if ($login->selecionarLoginPorEmailSenha() == 0) {
    echo '<script>alert("Email e/ou senha incorretos!");</script>';
    echo '<script>location.href="../view/entrar.html";</script>';
} 

// verificar se é email e senha de cliente
include '../model/cliente.php';
$cliente = new cliente();
$cliente->setEmail($login->getEmail());
$cliente->setSenha($login->getSenha());

if ($cliente->selecionarClientePorEmailSenha() != 0) {
    echo '<script>alert("Logadou como cliente!");</script>';
    // echo '<script>location.href="../view/entrar.html";</script>';
} 

// verificar se é email e senha de empresa
include '../model/empresa.php';
$empresa = new empresa();
$empresa->setEmail($login->getEmail());
$empresa->setSenha($login->getSenha());

if ($empresa->selecionarEmpresaPorEmailSenha() != 0) {
    echo '<script>alert("Logado como empresa!");</script>';
    // echo '<script>location.href="../view/entrar.html";</script>';
}