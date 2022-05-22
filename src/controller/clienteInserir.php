<?php
// verificar com foreach os campos do formulário com empty
// se estiverem vazios, então exibir mensagem de erro

foreach ($_POST as $key => $value){
    if (empty($value)){
        echo '<script>alert("Preencha todos os campos!");</script>';
        echo '<script>location.href="../view/clienteInserir";</script>';
    }
}

// verificar senha e confirmar senha
if ($_POST['senha'] != $_POST['confirmarSenha']){
    echo '<script>alert("Senhas não conferem!");</script>';
    echo '<script>location.href="../view/clienteInserir";</script>';
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

// abrir conexão em services connection.php
// require_once '../services/connection.php';

// // verificar se trouxe algum resultado
// if ($cliente->selectEmail() > 0) {
//     echo '<script>alert("Email já cadastrado!");</script>';
//     echo '<script>location.href="../view/clienteInserir";</script>';
// } else {
//     $cliente->cadastrarlogin();
//     echo $cliente->getCodLogin();
//     // $cliente->cadastrarEndereco();
//     // echo $cliente->getCodEndereco();
//     // $cliente->cadastrarCliente();
//     // echo $cliente->getCodCliente();
//     // echo '<script>alert("Cliente inserido com sucesso!");</script>';
//     // echo '<script>location.href="../view/entrar";</script>';
// }



// abrir conexão em services connection.php
require_once '../services/connection.php';

// inserir os campos de endereço
$sql = "INSERT INTO `endereco` (`cep`, `endereco`, `numero`, `complemento`, `cidade`, `estado`) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $cep);
$stmt->bindParam(2, $endereco);
$stmt->bindParam(3, $numero);
$stmt->bindParam(4, $complemento);
$stmt->bindParam(5, $cidade);
$stmt->bindParam(6, $estado);
$stmt->execute();
$codEndereco = $conn->lastInsertId(); // retorna o id do endereço inserido

$sql = "INSERT INTO `login` (`email`, `senha`) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $email);
$stmt->bindParam(2, $senha);
$stmt->execute();
$codLogin = $conn->lastInsertId(); // retorna o id do login inserido

$sql = "INSERT INTO `cliente` (`nome`, `sobrenome`, `dataNascimento`, `cpf`, `telefone`, `codEndereco`, `codLogin`) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $nome);
$stmt->bindParam(2, $sobrenome);
$stmt->bindParam(3, $dataNascimento);
$stmt->bindParam(4, $cpf);
$stmt->bindParam(5, $telefone);
$stmt->bindParam(6, $codEndereco);
$stmt->bindParam(7, $codLogin);
$stmt->execute();
$codCliente = $conn->lastInsertId(); // retorna o id do cliente inserido

echo "Cliente inserido com sucesso! Codigo do cliente: " . $cliente->getCodCliente();
?>