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


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>e-Letronic</title>
    <meta name="title" content="Inicio|e-Letronic">
    <meta name="description" content="Reciclagem de lixo eletrônico">

    <!-- Styles -->
    <link rel="stylesheet" href="../../libs/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="stylesheet" href="../../assets/styles/home.css">
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
            <a class="logo" href="index.html">e-<span>Letronic</span></a>
            <div class="menu">
                <ul class="grid">
                    <?php
                        echo '<li><a class="title" href="perfil-'. $logado->getTipo() .'.html">' . 
                        mb_strimwidth($logado->getTipo() == "cliente" ? $logado->getNome() : $logado->getRazaoSocial(), 0, 15) . '</a></li>'
                    ?>
                </ul>
            </div>
            <div class="toggle icon-menu"></div>
            <div class="toggle icon-close"></div>
        </nav>
    </header>

    <section class="section" id="home">
        <div class="container grid">
            <div class="text form-row">
                <h2 class="title">Como funciona?</h2>
                <p>É muito simples, basta clicar no botão abaixo para cadastrar um produto. Depois leva-lo no ponto mais próximo de você, mostrado no mapa a seguir.</p>
                <button type="button" onclick="location.href='cadastro-produto.html'" class="btn btn-success button">Começar!</button>
            </div>
            <div class="mapouter form-row">
                <div class="gmap_canvas"><iframe width="700" height="360" id="gmap_canvas" src="https://maps.google.com/maps?q=triaton%20-%20masp&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 360px;
                            width: 700px;
                            margin-top: 120px;
                        }
                    </style><a href="https://www.embedgooglemap.net">embed google my maps</a>
                    <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 360px;
                            width: 700px;
                        }
                    </style>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="section" id="testimonials">
            <div class="container">
                <header>
                    <h2 class="title">Seus produtos</h2>
                </header>
                <div class="testimonials swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        $produtoz = new Produto();
                        $produtos = $logado->getTipo() == "cliente" ? $produtoz->selecionarPorCodCliente($logado->getCodCliente()) : 
                                                                      $produtoz->selecionarPorCodEmpresa($logado->getCodEmpresa());
                        foreach ($produtos as $produto) {
                        echo '<div class="testimonial swiper-slide">
                            <blockquote>
                                <cite>
                                    <img src="../../assets/images/produto.jpg" alt="Foto do Produto">
                                </cite>
                                <p>' . $produto['modelo'] . '</p>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    ' . $produto['alterado'] . '
                                </small>
                            </blockquote>
                        </div>';
                        }
                        ?>
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
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

<!-- Swiper / Scroll -->
<script src="../../libs/swiper-bundle.min.js"></script>
<!-- Scroll Reveal -->
<script src="../../libs/scrollreveal.min.js"></script>
<!-- Scripts -->
<script src="../../main.js"></script>

</html>