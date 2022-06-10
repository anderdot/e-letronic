<?php
if (empty($_POST['email']) || empty($_POST['senha'])) {
    echo '<script>alert("Preencha todos os campos!");</script>';
    echo '<script>location.href="../view/entrar.html";</script>';
}

include '../model/login.php';
$login = new login();

$login->setEmail($_POST['email']);
$login->setSenha($_POST['senha']);
$dados = $login->selecionarLoginPorEmailSenha();

if ($dados == 0) {
    echo '<script>alert("Email e/ou senha incorretos!");</script>';
    echo '<script>location.href="../view/entrar.html";</script>';
}

session_start();

if ($dados['tipo'] == 'cliente') {
    include '../model/cliente.php';
    $cliente = new cliente();
    $cliente->setEmail($_POST['email']);
    $cliente->setSenha($_POST['senha']);
    $cliente->selecionarPorEmailSenha();

    $_SESSION['logado'] = serialize($cliente);
} else if ($dados['tipo'] == 'empresa') {
    include '../model/empresa.php';
    $empresa = new empresa();
    $empresa->setEmail($_POST['email']);
    $empresa->setSenha($_POST['senha']);
    $empresa->selecionarPorEmailSenha();

    $_SESSION['logado'] = serialize($empresa);
}

echo '<script>location.href="../view/home.php";</script>';
