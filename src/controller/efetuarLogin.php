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

if ($dados['tipo'] == 'cliente') {
    include '../model/cliente.php';
    $cliente = new cliente();
    $cliente->selecionarClientePorEmailSenha();
    echo '<script>alert("Bem-vindo, Cliente!");</script>';
    echo '<script>location.href="../view/perfil-cliente.html";</script>';
} else if ($dados['tipo'] == 'empresa') {
    include '../model/empresa.php';
    $empresa = new empresa();
    $empresa->selecionarEmpresaPorEmailSenha();
    echo '<script>alert("Bem-vindo, Empresa!");</script>';
    echo '<script>location.href="../view/perfil-empresa.html";</script>';
}
