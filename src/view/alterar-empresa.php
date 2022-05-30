<?php
include("../model/empresa.php");
// start a session
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

    <!-- Primary Meta Tags -->
    <title>e-Letronic</title>
    <meta name="title" content="Cadastro de Aliado|e-Letronic">
    <meta name="description" content="Reciclagem de lixo eletrônico">

    <!-- Styles -->
    <link rel="stylesheet" href="../../libs/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="stylesheet" href="../../assets/styles/cadastro-cliente.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <!-- Icons (icomoon.io) -->
    <link rel="stylesheet" href="../../assets/fonts/style.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap">

    <!-- Favicons -->
    <link rel="shortcut icon" href="../../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../assets/favicon.ico" type="image/x-icon">
    <meta name="msapplication-TileColor" content="#69B99D">
    <meta name="theme-color" content="#69B99D">

</head>

<body>
    <!-- Header -->
    <header id="header">
        <nav class="container">
            <a class="logo" href="home.php">e-<span>Letronic</span></a>
            <div class="menu">
                <ul class="grid">
                    <li><a class="title" href="../controller/excluir-empresa.php">Excluir</a></li>
                    <li><a class="title" href="perfil-empresa.php">Voltar</a></li>
                </ul>
            </div>
            <div class="toggle icon-menu"></div>
            <div class="toggle icon-close"></div>
        </nav>
    </header>

    <main>
        <!-- Home -->
        <section class="section" id="home">
            <div class="container grid">
                <div class="text">
                    <h2 class="title">Vamos ajudar o mundo juntos?</h2>
                    <p>Cadastre-se a seguir para se livrar dos seus eletrônicos antigos e assim, ajude o mundo.</p>
                    <p>Caso você seja uma empresa comprometida com isso e queira se juntar a causa, considere <a href="cadastro-empresa.html">se tornar um aliado</a>.</p>
                </div>

                <form action="../controller/alterarEmpresa.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputName">Razão Social</label>
                            <input type="text" name="razaoSocial" class="form-control" id="inputName" placeholder="Talita Maria LTDA" value="<?php echo $logado->getRazaoSocial() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="nome@exemplo.com" value="<?php echo $logado->getEmail() ?>" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="tel">Telefone</label>
                            <input type="text" name="telefone" class="form-control" id="tel" placeholder="(11) 95487-3614" data-mask="(00) 00000-0000" value="<?php echo $logado->getTelefone() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" name="cnpj" oninput="mascaraCnpj(this)" class="form-control" id="cnpj" placeholder="36.221.010/0001-16" value="<?php echo $logado->getCnpj() ?>"required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="estadual">I.E</label>
                            <input type="text" name="ie" class="form-control" id="estadual" data-mask="000.000.000.000" placeholder="528.645.038.635" value="<?php echo $logado->getIe() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="cep">CEP</label>
                            <input name="cep" type="text" class="form-control" id="cep" placeholder="05318-925" onblur="pesquisacep(this.value);" value="<?php echo $logado->getCep() ?>" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="rua">Endereço</label>
                            <input name="endereco" type="text" class="form-control" placeholder="Bandeira Paulista" id="rua" value="<?php echo $logado->getEndereco() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="typeNumber">Número</label>
                            <input type="text" name="numero" class="form-control" id="typeNumber" placeholder="3301" value="<?php echo $logado->getNumero() ?>"required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputAddress2">Complemento</label>
                            <input type="text" name="complemento" class="form-control" id="inputAddress2" placeholder="Bloco 1" value="<?php echo $logado->getComplemento() ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cidade">Cidade</label>
                            <input name="cidade" type="text" class="form-control" placeholder="São Paulo" id="cidade" value="<?php echo $logado->getCidade() ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uf">Estado</label>
                            <input name="estado" type="text" class="form-control" placeholder="SP" id="uf" value="<?php echo $logado->getEstado() ?>" required>
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
                    <button type="submit" class="btn btn-success button">Alterar</button>
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

<script src="../../scripts/cadastro-empresa.js"></script>
<script type='text/javascript' src='//code.jquery.com/jquery-compat-git.js'></script>
<script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>

<a href="#home" class="back-to-top"><i class="icon-arrow-up"></i></a>

<!-- Swiper / Scroll -->
<script src="../../libs/swiper-bundle.min.js"></script>
<!-- Scroll Reveal -->
<script src="../../libs/scrollreveal.min.js"></script>
<!-- Scripts -->
<script src="main.js"></script>

</html>