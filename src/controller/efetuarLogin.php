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
$dados = $login->selecionarLoginPorEmailSenha();

// verificar se email e senha existem
if ($dados == 0) {
    echo '<script>alert("Email e/ou senha incorretos!");</script>';
    echo '<script>location.href="../view/entrar.html";</script>';
}

// começa uma sessão
session_start();

if ($dados['tipo'] == 'cliente') {
    include '../model/cliente.php';
    $cliente = new cliente();
    $cliente->setEmail($_POST['email']);
    $cliente->setSenha($_POST['senha']);
    $cliente->selecionarPorEmailSenha();

    // carregar dados do cliente na sessão
    $_SESSION['logado'] = serialize($cliente);
    // echo '<script>alert("Bem-vindo, Cliente!");</script>';
} else if ($dados['tipo'] == 'empresa') {
    include '../model/empresa.php';
    $empresa = new empresa();
    $empresa->setEmail($_POST['email']);
    $empresa->setSenha($_POST['senha']);
    $empresa->selecionarPorEmailSenha();

    // carregar dados da empresa na sessão
    $_SESSION['logado'] = serialize($empresa);
    // echo '<script>alert("Bem-vindo, Empresa!");</script>';
}

echo '<script>location.href="../view/home.php";</script>';