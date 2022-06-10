<?php
include("../model/cliente.php");
session_start();
$logado = unserialize($_SESSION['logado']);

if ($logado == null) {
    header("Location: ../view/login.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Letronic</title>
    <meta name="title" content="Alterar Cliente|e-Letronic">
    <meta name="description" content="Reciclagem de lixo eletrônico">

    <link rel="stylesheet" href="../../libs/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="stylesheet" href="../../assets/styles/cadastro-cliente.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <link rel="stylesheet" href="../../assets/fonts/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap">

    <link rel="shortcut icon" href="../../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../assets/favicon.ico" type="image/x-icon">
    <meta name="msapplication-TileColor" content="#69B99D">
    <meta name="theme-color" content="#69B99D">


</head>

<body>
    <header id="header">
        <nav class="container">
            <a class="logo" href="home.php">e-<span>Letronic</span></a>
            <div class="menu">
                <ul class="grid">
                    <li><a class="title" href="../controller/excluirCliente.php">Excluir</a></li>
                    <li><a class="title" href="perfil-cliente.php">Voltar</a></li>
                </ul>
            </div>
            <div class="toggle icon-menu"></div>
            <div class="toggle icon-close"></div>
        </nav>
    </header>

    <main>
        <section class="section" id="home">
            <div class="container grid">
                <div class="text">
                    <h2 class="title">Edite seu perfil!</h2>
                    <p>LOREM Cadastre-se a seguir para se livrar dos seus eletrônicos antigos e assim, ajude o mundo.</p>
                    <p>LOREM Caso você seja uma empresa comprometida com isso e queira se juntar a causa, considere <a href="cadastro-empresa.html">se tornar um aliado</a>.</p>
                </div>

                <form action="../controller/alterarCliente.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Nome</label>
                            <input type="text" name="nome" class="form-control" id="inputName" placeholder="Celso" value="<?php echo $logado->getNome() ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName2">Sobrenome</label>
                            <input type="text" name="sobrenome" class="form-control" id="inputName2" placeholder="Portioli" value="<?php echo $logado->getSobrenome() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="nome@exemplo.com" value="<?php echo $logado->getEmail() ?>" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="phone">Telefone</label>
                            <input type="text" name="telefone" onkeypress="mascaraTelefone(this, meuCelular);" onblur="mascaraTelefone(this, meuCelular);" class="form-control" id="phone" placeholder="(11) 95487-3614" data-mask="(00) 00000-0000" value="<?php echo $logado->getTelefone() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCPF">CPF</label>
                            <input type="text" name="cpf" oninput="mascaraCpf(this)" class="form-control" placeholder="168.209.468-22" id="inputCPF" value="<?php echo $logado->getCPF() ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNasc">Data Nascimento</label>
                            <input type="text" name="dataNascimento" class="form-control" id="inputNasc" placeholder="12/04/1961" data-mask="00/00/0000" value="<?php echo $logado->getDataNascimento() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="cep">CEP</label>
                            <input type="text" name="cep" class="form-control" id="cep" placeholder="05318-925" onblur="pesquisacep(this.value);" data-mask="00000-000" value="<?php echo $logado->getCep() ?>" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="rua">Endereço</label>
                            <input type="text" name="endereco" class="form-control" placeholder="Rua dos alfeneiros" id="rua" value="<?php echo $logado->getEndereco() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="typeNumber">Número</label>
                            <input type="number" name="numero" class="form-control" id="typeNumber" placeholder="04" value="<?php echo $logado->getNumero() ?>" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputAddress2">Complemento</label>
                            <input type="text" name="complemento" class="form-control" id="inputAddress2" placeholder="Bloco 1" value="<?php echo $logado->getComplemento() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="São Paulo" value="<?php echo $logado->getCidade() ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uf">Estado</label>
                            <input type="text" name="estado" class="form-control" id="uf" placeholder="SP" value="<?php echo $logado->getEstado() ?>" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword">Nova Senha</label>
                            <input type="password" name="novaSenha" class="form-control" id="inputPassword" placeholder="Senha" value="" required>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Senha de 8-16 caracteres.
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword2">Confirmar Nova Senha</label>
                            <input type="password" name="confirmarNovaSenha" class="form-control" id="inputPassword2" placeholder="Senha" value="" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success button">Atualizar</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="section">
        <div class="container grid">
            <div class="brand">
                <a class="logo logo-alt" href="#home">e-<span>Letronic</span></a>
                <p>2022 e-Letronic</p>
                <p>Todos os direitos reservados.</p>
            </div>
            <div class="social">
                <a href="#" target="_blank"><i class="icon-instagram"></i></a>
                <a href="#" target="_blank"><i class="icon-facebook"></i></a>
                <a href="#" target="_blank"><i class="icon-youtube"></i></a>
            </div>
        </div>
    </footer>
</body>

<script src="../../scripts/cadastro-cliente.js"></script>
<script type='text/javascript' src='//code.jquery.com/jquery-compat-git.js'></script>
<script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>

<a href="#home" class="back-to-top"><i class="icon-arrow-up"></i></a>

<script src="../../libs/swiper-bundle.min.js"></script>
<script src="../../libs/scrollreveal.min.js"></script>
<script src="main.js"></script>

</html>