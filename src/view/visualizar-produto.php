<?php
include("../model/cliente.php");
include("../model/empresa.php");
include("../model/produto.php");
// start a session
session_start();
$logado = unserialize($_SESSION['logado']);

if ($logado == null) {
    header("Location: ../view/login.php");
}

$produto = new produto();
$produto->setCodProduto($_GET['codProduto']);
$produto->selecionarPorCod();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>e-Letronic</title>
    <meta name="title" content="Produto|e-Letronic">
    <meta name="description" content="Reciclagem de lixo eletrônico">

    <!-- Styles -->
    <link rel="stylesheet" href="../../libs/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="stylesheet" href="../../assets/styles/cadastro-cliente.css">
    <link rel="stylesheet" href="../../assets/styles/cadastro-produto.css">
    <!-- bootstrap.bundle.js -->

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
                    <?php
                    if ($logado->getTipo() == "cliente") {
                        echo '<li><a class="title" href="alterar-produto.php?codProduto=' . $_GET['codProduto'] . '">Editar Produto</a></li>';
                    }
                    ?>
                    <li><a class="title" href="home.php">Voltar</a></li>
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
                <form class="mt-3">
                    <div class="form-group col-md-10">
                        <label for="inputTipo"><strong>Status</strong></label>
                        <input type="text" class="form-control" id="inputtype5" value="<?php echo $produto->getNomeStatus() ?>"  disabled>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Atualizado em <?php echo $produto->getAlterado() ?>
                        </small>
                    </div>
                    <div class="form-group col-md-10">
                        <label for="inputTipo"><strong>Cashback</strong></label>
                        <input type="text" class="form-control" id="inputtype5" value="BRL <?php echo $produto->getCashback() ?>" disabled>
                    </div>
                    <div class="form-group col-md-10">
                        <img src="../../assets/images/qrcode.jpg" alt="QR Code" class="img-fluid">
                    </div>
                </form>
                <form class="mt-3">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputTipo">Tipo</label>
                            <input type="text" class="form-control" id="inputtype5" placeholder="Smartphone" value="<?php echo $produto->getTipo() ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputModelo">Modelo</label>
                            <input type="text" class="form-control" id="inputtype4" placeholder="Samsung i7500" value="<?php echo $produto->getModelo() ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputFuncionando">O produto está funcionando?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="funcionando" id="funcionandoSim" value="sim" <?php echo $produto->getFuncionando() == 'Sim' ? 'checked' : '' ?> disabled>
                                <label class="form-check-label" for="funcionandoSim">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="funcionando" id="funcionandoNao" value="nao" <?php echo $produto->getFuncionando() == 'Não' ? 'checked' : '' ?> disabled>
                                <label class="form-check-label" for="funcionandoNao">
                                    Não
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputTipo">Tempo de uso</label>
                            <input type="text" class="form-control" id="inputtype4" placeholder="3 anos e 2 meses" value="<?php echo $produto->getTempoUso() ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputTipo">Descritivo</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Apenas rachou a tela." value="<?php echo $produto->getEspecificacoes() ?>" disabled></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="custom-file form-group col-md-12">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="pt-br" disabled>
                            <label class="custom-file-label" for="customFileLang">Selecionar arquivo</label>
                        </div>
                    </div>
                    <!-- <button type="submit" class="btn btn-success button mt-3">Atualizar</button> -->
                </form>
            </div>
        </section>
    </main>

    <footer class="section ">
        <div class="container grid ">
            <div class="brand ">
                <a class="logo logo-alt " href="#home ">e-<span>Letronic</span></a>
                <p>2022 e-Letronic</p>
                <p>Todos os direitos reservados.</p>
            </div>
            <div class="social ">
                <a href="# " target="_blank "><i class="icon-instagram "></i></a>
                <a href="# " target="_blank "><i class="icon-facebook "></i></a>
                <a href="# " target="_blank "><i class="icon-youtube "></i></a>
            </div>
        </div>
    </footer>
</body>

<script src="../../scripts/cadastro-cliente.js "></script>

<a href="#home " class="back-to-top "><i class="icon-arrow-up "></i></a>

<!-- Swiper / Scroll -->
<script src="../../libs/swiper-bundle.min.js "></script>
<!-- Scroll Reveal -->
<script src="../../libs/scrollreveal.min.js "></script>
<!-- Scripts -->
<script src="main.js "></script>

</html>