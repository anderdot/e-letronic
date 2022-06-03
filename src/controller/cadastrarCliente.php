<?php
foreach ($_POST as $key => $value){
    if (empty($value)){
        echo '<script>alert("Preencha todos os campos!");</script>';
        echo '<script>location.href="../view/cadastro-cliente.html";</script>';
    }
}

if ($_POST['senha'] != $_POST['confirmarSenha']){
    echo '<script>alert("Senhas não conferem!");</script>';
    echo '<script>location.href="../view/cadastro-cliente.html";</script>';
}

include '../model/cliente.php';
$cliente = new cliente();
$cliente->setNome($_POST['nome']);
$cliente->setSobrenome($_POST['sobrenome']);
$cliente->setEmail($_POST['email']);
$cliente->setTelefone($_POST['telefone']);
$cliente->setCpf($_POST['cpf']);
$cliente->setDataNascimento($_POST['dataNascimento']);
$cliente->setCep($_POST['cep']);
$cliente->setEndereco($_POST['endereco']);
$cliente->setNumero($_POST['numero']);
$cliente->setComplemento($_POST['complemento']);
$cliente->setCidade($_POST['cidade']);
$cliente->setEstado($_POST['estado']);
$cliente->setSenha($_POST['senha']);
$cliente->setTipo('cliente');

if ($cliente->selecionarEmail() > 0) {
    echo '<script>alert("Email já cadastrado!");</script>';
    echo '<script>location.href="../view/cadastro-cliente.html";</script>';
} else {
    $cliente->cadastrarlogin();
    $cliente->cadastrarEndereco();
    $cliente->cadastrarCliente();
    echo '<script>alert("Cliente inserido com sucesso!");</script>';
    echo '<script>location.href="../view/entrar.html";</script>';
}
?>