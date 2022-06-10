<?php
foreach ($_POST as $key => $value) {
    if (empty($value)) {
        echo '<script>alert("Preencha todos os campos!");</script>';
        echo '<script>location.href="../view/cadastro-empresa.html";</script>';
    }
}

if ($_POST['senha'] != $_POST['confirmarSenha']) {
    echo '<script>alert("Senhas não conferem!");</script>';
    echo '<script>location.href="../view/cadastro-empresa.html";</script>';
}

include '../model/empresa.php';
$empresa = new empresa();
$empresa->setRazaoSocial($_POST['razaoSocial']);
$empresa->setEmail($_POST['email']);
$empresa->setTelefone($_POST['telefone']);
$empresa->setCnpj($_POST['cnpj']);
$empresa->setIe($_POST['ie']);
$empresa->setCep($_POST['cep']);
$empresa->setEndereco($_POST['endereco']);
$empresa->setNumero($_POST['numero']);
$empresa->setComplemento($_POST['complemento']);
$empresa->setCidade($_POST['cidade']);
$empresa->setEstado($_POST['estado']);
$empresa->setSenha($_POST['senha']);
$empresa->setTipo('empresa');

if ($empresa->selecionarEmail() > 0) {
    echo '<script>alert("Email já cadastrado!");</script>';
    echo '<script>location.href="../view/cadastro-empresa.html";</script>';
} else {
    $empresa->cadastrarlogin();
    $empresa->cadastrarEndereco();
    $empresa->cadastrarEmpresa();
    echo '<script>alert("Empresa inserido com sucesso!");</script>';
    echo '<script>location.href="../view/entrar.html";</script>';
}
