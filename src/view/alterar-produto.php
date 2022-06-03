<?php
include("../model/cliente.php");
include("../model/empresa.php");
include("../model/produto.php");
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

    <title>e-Letronic</title>
    <meta name="title" content="Alterar Produto|e-Letronic">
    <meta name="description" content="Reciclagem de lixo eletrônico">

    <link rel="stylesheet" href="../../libs/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="stylesheet" href="../../assets/styles/cadastro-cliente.css">
    <link rel="stylesheet" href="../../assets/styles/cadastro-produto.css">

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
                    <li><a class="title" href="../controller/excluirProduto.php?codProduto=<?php echo $_GET['codProduto'] ?>">Excluir Produto</a></li>
                    <li><a class="title" href="home.php">Voltar</a></li>
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
                    <h2 class="title">Se livre dos eletrônicos antigos</h2>
                    <p>Altere agora o produto, e após o envio e analises de especialistas, receba <a href="#">um cashback</a>.</p>
                </div>

                <form action="../controller/alterarProduto.php" method="post" class="mt-3">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputTipo">Tipo</label>
                            <input type="text" name="tipo" class="form-control" id="inputtype5" placeholder="Smartphone" value="<?php echo $produto->getTipo() ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputModelo">Modelo</label>
                            <input type="text" name="modelo" class="form-control" id="inputtype4" placeholder="Samsung i7500" value="<?php echo $produto->getModelo() ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputFuncionando">O produto está funcionando?</label>
                            <div class="form-check">
                                <input type="radio" name="funcionandoSim" class="form-check-input" id="funcionandoSim" value="sim" <?php echo $produto->getFuncionando() == 'Sim' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="funcionandoSim">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="funcionandoNão" class="form-check-input" id="funcionandoNao" value="nao" <?php echo $produto->getFuncionando() == 'Não' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="funcionandoNao">
                                    Não
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputTipo">Tempo de uso</label>
                            <input type="text" name="tempoUso" class="form-control" id="inputtype4" placeholder="3 anos e 2 meses" value="<?php echo $produto->getTempoUso() ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputTipo">Descritivo</label>
                            <textarea name="descritivo" class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Apenas rachou a tela." value="<?php echo $produto->getEspecificacoes() ?>"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="custom-file form-group col-md-12">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="pt-br">
                            <label class="custom-file-label" for="customFileLang">Selecionar arquivo</label>
                        </div>
                    </div>
                    <input type="text" name="codProduto" value="<?php echo $produto->getCodProduto() ?>" hidden>
                    <button type="submit" class="btn btn-success button mt-3">Atualizar</button>
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

<script src="../../libs/swiper-bundle.min.js "></script>
<script src="../../libs/scrollreveal.min.js "></script>
<script src="main.js "></script>

</html>