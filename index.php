<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->

    <title>MelodiaShop</title>
    <link rel="stylesheet" href="./assets/scss/style.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    
            
</head>

<body>

<?php 
     
     ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    include 'conexao.php';
    session_start();

 

    //consulta de produtos por categoria

    $consultaG = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'guitarra'");
    $consultaP = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'piano'");
    $consultaB = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'bateria'");
    $consultaV = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'violino'");
    $consultaV2 = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'violão'");
    $consultaS = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'saxofone'");
    $consultaT = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'teclado'");
    $consultaCart = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where cart_prod= 1 ");
    $idCli = $_SESSION['ID'] ;
    $consultaCli = $cn->query("select nome_cli from cliente where id_cli = '$idCli'");
    $exibeCli = $consultaCli->fetch(PDO::FETCH_ASSOC);

    

    ?>

    <!-- Inicio Header -->
    <header class="container-fluid">
        <!-- Container -->
        <section class="container">
            <!-- Row - colunas -->
            <article class="row d-flex align-items-center">
                <!-- "Logo" -->
                <a href="index.php" class="col-md-3  d-flex justify-content-center">
                    <img src="assets/images/Logo branco total.png" class="img-fluid logo" alt="Logo MelodiaShop">
                </a>
                <!-- Buscar -->
                <form action="index.php" class="col-md-6 d-flex align-items-center">
                    <input type="text" name="txtbuscar" placeholder="Pesquisar Instrumentos aqui">

                    <button class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </form>
                <!-- login funcionario -->
                <?php 
                
               
                ?>

                <ul class="col-md-3 nav d-flex align-items-center justify-content-around">
                    <li class="nav-item">
                        <?php if (empty($_SESSION['ID'])){?>
                        <a href="login-funcionario.php">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            Entrar
                        </a>
                        <?php } else{?>
                            <a href="sair.php">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            <?php echo $exibeCli['nome_cli'];?>
                        </a><?php } ?>
                    </li>

                    <li class="nav-item">
                    <a href="#" id="cart-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" class="bi bi-cart-fill " >
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    
                            </svg>  
                            Carrinho
                            
                            
                        </a>
                        <!-- Carrinho -->

                        <div class="cart" style="z-index:1000">
                                <h2 class="cart-title">Seu Carrinho</h2>
                                <div class="cart-content">
                                <?php if (isset($_SESSION['ID'])){?>    
                                <?php  while($exibe = $consultaCart->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <div class="cart-box">
                                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid cart-img"
                        alt="Guitarras">
                            <div class="detail-box">
                                <div class="cart-product-title"><?php echo $exibe['nome_prod'];?></div>
                                <div class="cart-price">R$<?php echo $exibe['valor'];?></div>
                            </div>
                           
                            <!--Remover-->
                            <a href="Cart0.php?id=<?php echo $exibe['id_prod']; ?>">
                            <i class="bx bxs-trash-alt cart-remove"></i>
                            </a>
                                    </div>   
                                    <?php } ?>                             
                                </div>
                                <?php } else{?>

                            

                                <?php } ?>
                                <!--Fechar Carrinho-->
                                <i class='bx bx-x' id="close-cart"></i>
                                <a href="Carrinho.php">
                            <button type="button" class="btn btn-success col-md-12 finaliza">Finalizar compra</button>
                            </a>
                           

                            </div>
                    </li>
                </ul>
                
                <!-- fim login funcionario -->
            </article>
            <!-- Fim Row -->
        </section>
        <!-- Fim Container -->
    </header>
    <!-- Fim do Header -->

    <!-- Inicio Menu do Site -->
    <nav class="container-fluid nav-produtos ">
        <!-- Container -->
        <section class="container">
            <!-- Menu -->
            <ul class="nav">
                <!-- Lista de itens -->
                <li class="col-xl-2 col-md-12 nav-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                        class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    Instrumentos
                    <!-- SubMenu -->
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#guitarra">
                                Guitarra
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#violões">
                                Violão
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#bateria">
                                Bateria
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="#piano">
                                Piano
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#violinos">
                                Violino
                            </a>
                        </li>

                    </ul>
                    <!-- Fim SubMenu -->
                </li>
                <!-- Lista de intens -->

                
    </nav>
    <!-- Fim Menu do Site -->


    <main>

        <!-- Slides Banners de Promoção -->
        <section id="banners-promocionais" class="carousel slide" data-bs-ride="true" data-ride="carousel">

            <!-- Imagens -->
            <article class="carousel-inner">
                <figure class="carousel-item active">
                    <img src="./assets/images/1.png" class="d-block w-100" alt="Banner Promocional">
                </figure>
                <figure class="carousel-item">
                    <img src="./assets/images/2.png" class="d-block w-100" alt="Banner Promocional 2">
                </figure>
                <figure class="carousel-item">
                    <img src="./assets/images/3.png" class="d-block w-100"
                        alt="Banner Promocional 3.png">
                </figure>
            </article>

            <!-- Botão Anterior -->
            <a class="carousel-control-prev" type="button" href="#banners-promocionais" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"></span>
            </a>

            <!-- Botão Proximo -->
            <a class="carousel-control-next" type="button" href="#banners-promocionais" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"></span>
            </a>
        </section>
        <!-- Fim Slides Banners de Promoção -->

        <!-- Banners de Promoção com 6 colunas -->
        <section class="container banners-promocionais-statico">
            <!-- Row -->
            <section class="row ">
                <!-- Banner -->
                <article class="col-md-6">

                    <div class="banners-promocionais-statico-12x d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                            class="bi bi-credit-card" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
                        </svg>
                        <p>Parcele em até<br>
                            <strong> 12x sem juros</strong>
                        </p>
                    </div>

                </article>

                <!-- Banner -->
                <article class="col-md-6">
                    <div class="banners-promocionais-statico-todo-br d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                            class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <p>
                            Entrega para <br>
                            <strong>todo Brasil</strong>
                        </p>

                    </div>
                </article>

            </section>
            <!-- Fim Row -->
        </section>
        <!-- Fim Banners de Promoção com 6 colunas -->

        <!-- Container Produtos -->
       
        <section class="container produtos">
            <!-- Guitarras -->
            <?php if($consultaG-> rowCount() >= 1) { ?>
            <h1 class="text-center" id="guitarra">Guitarras</h1>
            <!-- Listagem dos Produtos -->
            <article class="row guitarra">
            <?php  while($exibe = $consultaG->fetch(PDO::FETCH_ASSOC)){ ?>
                <!-- Produtos 1 -->
                <a href="index.php?id=<?php echo $exibe['id_prod']; ?>" class="produtos-container col-md-3" >
                    <!-- Imagem do Produto -->
                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid  product-img"
                        alt="Guitarras">
                    <!-- Itens do Produto -->
                    <article class="produtos-itens">
                        <!-- Nome do Produto -->
                        <h2 class="product-title"><?php echo mb_strimwidth($exibe['nome_prod'], 0,30,'...');?></h2>
                        <!-- Estrelas do Produto -->
                        <div class="produtos-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                


                        </div>
                        <!-- Preço do Produto -->
                        <strong class="produtos-preco price">
                        R$ <?php echo number_format($exibe['valor'],2,',','.');?>
                        </strong>
                    </article>

                    <!-- Fim Itens do Produto -->
                </a>
                <?php }}?>
                <!-- Fim Produtos -->

            </article>
            <!-- Fim Listagem dos Produtos -->

            <!-- Pianos -->
            <?php if($consultaP-> rowCount() >= 1) { ?>
            <h1 class="text-center" id="piano">Pianos</h1>
            <!-- Listagem dos Produtos -->
            <article class="row">
            <?php  while($exibe = $consultaP->fetch(PDO::FETCH_ASSOC)){ ?>
                <!-- Produtos 1 -->
                <a href="index.php?id=<?php echo $exibe['id_prod']; ?>" class="produtos-container col-md-3">
                    <!-- Imagem do Produto -->
                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"
                        alt="Pianos">
                    <!-- Itens do Produto -->
                    <article class="produtos-itens">
                        <!-- Nome do Produto -->
                        <h2><?php echo mb_strimwidth($exibe['nome_prod'], 0,30,'...');?></h2>
                        <!-- Estrelas do Produto -->
                        <div class="produtos-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
               


                        </div>
                        <!-- Preço do Produto -->
                        <strong class="produtos-preco">
                        R$:<?php echo number_format($exibe['valor'],2,',','.');?>
                        </strong>
                    </article>
                    <!-- Fim Itens do Produto -->
                </a>
                <?php }} ?>
                <!-- Fim Produtos -->

                
            </article>
            <!-- Fim Listagem dos Produtos -->

             <!-- Pianos -->
             <?php if($consultaT-> rowCount() >= 1) { ?>
             <h1 class="text-center" id="piano">Teclado</h1>
            <!-- Listagem dos Produtos -->
            <article class="row">
            <?php  while($exibe = $consultaT->fetch(PDO::FETCH_ASSOC)){ ?>
                <!-- Produtos 1 -->
                <a href="index.php?id=<?php echo $exibe['id_prod']; ?>" class="produtos-container col-md-3">
                    <!-- Imagem do Produto -->
                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"
                        alt="Pianos">
                    <!-- Itens do Produto -->
                    <article class="produtos-itens">
                        <!-- Nome do Produto -->
                        <h2><?php echo mb_strimwidth($exibe['nome_prod'], 0,30,'...');?></h2>
                        <!-- Estrelas do Produto -->
                        <div class="produtos-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                


                        </div>
                        <!-- Preço do Produto -->
                        <strong class="produtos-preco">
                        R$:<?php echo number_format($exibe['valor'],2,',','.');?>
                        </strong>
                    </article>
                    <!-- Fim Itens do Produto -->
                </a>
                <?php }} ?>
                <!-- Fim Produtos -->

                
            </article>
            <!-- Fim Listagem dos Produtos -->




            <!-- Pianos -->
            <?php if($consultaB-> rowCount() >= 1) { ?>
            <h1 class="text-center" id="bateria">Baterias</h1>
            <!-- Listagem dos Produtos -->
            <article class="row">
            <?php  while($exibe = $consultaB->fetch(PDO::FETCH_ASSOC)){ ?>
                <!-- Produtos 1 -->
                <a href="index.php?id=<?php echo $exibe['id_prod']; ?>" class="produtos-container col-md-3">
                    <!-- Imagem do Produto -->
                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"
                        alt="Baterias">
                    <!-- Itens do Produto -->
                    <article class="produtos-itens">
                        <!-- Nome do Produto -->
                        <h2><?php echo mb_strimwidth($exibe['nome_prod'], 0,30,'...');?></h2>
                        <!-- Estrelas do Produto -->
                        <div class="produtos-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                    


                        </div>
                        <!-- Preço do Produto -->
                        <strong class="produtos-preco">
                        R$:<?php echo number_format($exibe['valor'],2,',','.');?>
                        </strong>
                    </article>
                    <!-- Fim Itens do Produto -->
                </a>
                <?php }} ?>
                <!-- Fim Produtos -->

            </article>
            <!-- Fim Listagem dos Produtos -->

             <!-- Pianos -->
             <?php if($consultaV2-> rowCount() >= 1) { ?>
             <h1 class="text-center" id="violões">Violões</h1>
            <!-- Listagem dos Produtos -->
            <article class="row">
            <?php  while($exibe = $consultaV2->fetch(PDO::FETCH_ASSOC)){ ?>
                <!-- Produtos 1 -->
                <a href="index.php?id=<?php echo $exibe['id_prod']; ?>" class="produtos-container col-md-3">
                    <!-- Imagem do Produto -->
                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"
                        alt="Violões">
                    <!-- Itens do Produto -->
                    <article class="produtos-itens">
                        <!-- Nome do Produto -->
                        <h2><?php echo mb_strimwidth($exibe['nome_prod'], 0,30,'...');?></h2>
                        <!-- Estrelas do Produto -->
                        <div class="produtos-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                      


                        </div>
                        <!-- Preço do Produto -->
                        <strong class="produtos-preco">
                        R$:<?php echo number_format($exibe['valor'],2,',','.');?>
                        </strong>
                    </article>
                    <!-- Fim Itens do Produto -->
                </a>
                <?php }} ?>
                <!-- Fim Produtos -->

            </article>
            <!-- Fim Listagem dos Produtos -->

             <!-- Pianos -->
             <?php if($consultaV-> rowCount() >= 1) { ?>
             <h1 class="text-center" id="violinos">Violinos</h1>
            <!-- Listagem dos Produtos -->
            <article class="row">
            <?php  while($exibe = $consultaV->fetch(PDO::FETCH_ASSOC)){ ?>
                <!-- Produtos 1 -->
                <a href="index.php?id=<?php echo $exibe['id_prod']; ?>" class="produtos-container col-md-3">
                    <!-- Imagem do Produto -->
                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"
                        alt="Baterias">
                    <!-- Itens do Produto -->
                    <article class="produtos-itens">
                        <!-- Nome do Produto -->
                        <h2><?php echo mb_strimwidth($exibe['nome_prod'], 0,30,'...');?></h2>
                        <!-- Estrelas do Produto -->
                        <div class="produtos-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                    

                        </div>
                        <!-- Preço do Produto -->
                        <strong class="produtos-preco">
                        R$:<?php echo number_format($exibe['valor'],2,',','.');?>
                        </strong>
                    </article>
                    <!-- Fim Itens do Produto -->
                </a>
                <?php }} ?>
                <!-- Fim Produtos -->

            </article>
            <!-- Fim Listagem dos Produtos -->

            <?php if($consultaS-> rowCount() >= 1) { ?>
            <h1 class="text-center" id="violinos">Saxofones</h1>
            <!-- Listagem dos Produtos -->
            <article class="row">
            <?php  while($exibe = $consultaS->fetch(PDO::FETCH_ASSOC)){ ?>
                <!-- Produtos 1 -->
                <a href="index.php?id=<?php echo $exibe['id_prod']; ?>" class="produtos-container col-md-3">
                    <!-- Imagem do Produto -->
                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"
                        alt="Baterias">
                    <!-- Itens do Produto -->
                    <article class="produtos-itens">
                        <!-- Nome do Produto -->
                        <h2><?php echo mb_strimwidth($exibe['nome_prod'], 0,30,'...');?></h2>
                        <!-- Estrelas do Produto -->
                        <div class="produtos-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                     


                        </div>
                        <!-- Preço do Produto -->
                        <strong class="produtos-preco">
                        R$:<?php echo number_format($exibe['valor'],2,',','.');?>
                        </strong>
                    </article>
                    <!-- Fim Itens do Produto -->
                </a>
                <?php }} ?>
                <!-- Fim Produtos -->

            </article>

        </section >
        <!-- Fim Container Produtos -->

        <?php 

        if(!empty($_GET['id']))
        {
            include 'detalhes.php';
            
           echo "<script>window.scrollTo(0, 6500)</script>";
        }

        $consulta = $cn->query("select * from produto where nome_prod like concat ('%','$pesquisar','%')");
        if(!empty($_GET['txtbuscar']) and  $consulta->rowCount() >= 1)
        {
            include 'buscar.php';
            echo "<script>window.scrollTo(0, 6500)</script>";
            
        }else if(isset($_GET['txtbuscar'])){
            echo "<script lang='JavaScript'> window.alert('Este produto não existe!');</script>";
		    header('location:index.php');
            echo "<script>window.scrollTo(0, 0)</script>";
        }
        
        
        

        ?>

    </main>

    <!-- Footer -->
    <footer class="container-fluid">
        <!-- Container -->
        <section class="container">
            <!-- Menus -->
            <section class="row">
                <!-- Atendimento -->
                <article class="col-md-4">
                    <h4>
                        Atendimento
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#">(11) 9 9999-9999</a>
                        </li>
                        <li class="nav-item">
                            <a href="mailto:contato@loja.com.br">contato@loja.com.br</a>
                        </li>
                        <li class="nav-item">
                            Horario de Atendimento on-line: Segunda à sexta da 9:00 as 19:00
                        </li>

                    </ul>
                </article>
                <!-- Fim Atendimento -->

                <!-- Acesso Rápido -->
                <article class="col-md-3">
                    <h4>
                        Acesso Rápido
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#">Minha Conta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Meus Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Rastrear meu Pedido</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Troca e Devoluções</a>
                        </li>
                    </ul>
                </article>
                <!-- Fim Acesso Rápido -->

                <!-- Institucional -->
                <article class="col-md-3">
                    <h4>
                        Institucional
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#">Sobre a Loja</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Politica e Privacidade</a>
                        </li>
                    </ul>
                </article>
                <!-- Fim Institucional -->

                <!-- Mais Acessados-->
                <article class="col-md-2">
                    <h4>
                        Mais Acessados
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#">Guitarra Ibanez</a>
                        </li>
                        <li class="nav-item ellipsis">
                            <a href="#">Guitarra Tagima</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Guitarra Special Tribute</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Guitarra Les Paul Vintage</a>
                        </li>
                    </ul>
                </article>
                <!-- Fim Mais Acessados -->

            </section>
            <!-- Fim Menus -->
        </section>
        <!-- Fim Container -->
    </footer>
    <!-- Fim Footer -->


    <!-- Arquivos do Bootstrap -->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/pooper.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
</body>



</html>