<?php
// verificar depois se elas são vazias com isset
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$dataNascimento = $_POST['dataNascimento'];
$cep = $_POST['cep'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$senha = $_POST['senha'];
$confirmaSenha = $_POST['confirmaSenha'];

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

echo "Cliente inserido com sucesso! Codigo do cliente: " . $codCliente;
?>