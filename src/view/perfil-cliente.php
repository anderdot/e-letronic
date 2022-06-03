<?php
include("../model/cliente.php");
include("../model/produto.php");

session_start();
$logado = unserialize($_SESSION['logado']);

if ($logado == null) {
    header("Location: ../view/login.php");
}

$produto = new produto();
$inf = $produto->selecionarPorUltimaAtualizacao($logado->getCodCliente());
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>e-Letronic</title>
    <meta name="title" content="Perfil|e-Letronic">
    <meta name="description" content="Reciclagem de lixo eletrônico">

    <link rel="stylesheet" href="../../libs/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="stylesheet" href="../../assets/styles/perfil-cliente.css">

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
                    <li><a class="title" href="../view/alterar-cliente.php">Editar Perfil</a></li>
                    <li><a class="title" href="../controller/sair.php">Sair</a></li>
                </ul>
            </div>
            <div class="toggle icon-menu"></div>
            <div class="toggle icon-close"></div>
        </nav>
    </header>

    <main>
        <section class="section" id="home">
            <div class="container grid">
                <form>
                    <div class="form-group col-md-10 mt-5">
                        <label for="inputTipo"><strong>Status</strong></label>
                        <input type="text" class="form-control" id="inputtype5" value="<?php echo $inf['nomeStatus']?>" disabled>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Atualizado em <?php echo $inf['alterado'] ?>
                        </small>
                    </div>
                    <div class="form-group col-md-10">
                        <label for="inputTipo"><strong>Cashback</strong></label>
                        <input type="text" class="form-control" id="inputtype5" value="BRL <?php echo $inf['cashback'] ?>" disabled>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="section mt-5">
        <div class="container grid">
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


<script src="../../libs/swiper-bundle.min.js"></script>
<script src="../../libs/scrollreveal.min.js"></script>
<script src="../../main.js"></script>

</html>