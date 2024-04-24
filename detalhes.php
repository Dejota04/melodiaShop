<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->

    <title>PURE. Music</title>
    <link rel="stylesheet" href="./assets/scss/style.css">

</head>


<body>

<?php
    session_start();
    $id_prod = $_GET['id'];
    $n = 1;
    $detalhes = $cn ->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where id_prod ='$id_prod'"); 
    $exibeDetalhes = $detalhes->fetch(PDO::FETCH_ASSOC);

    ?>

<section class="container shop container" id="guitarra preta">
    <div class="shop-content">
    <h3 class="text-center" >Detalhes</h3>
            <article class="row produtos-compra">
                <figure class="col-md-7 mb-5">
                    <img src="./assets/images/<?php echo $exibeDetalhes['img_prod'];?>" class="img-fluid product-img "
                        alt="erro">
                </figure>
                <section class="col-md-5 mb-5 d-flex flex-column justify-content-around">
                    <article class="produtos-conteudo">
                        <h1 class="product-title"><?php echo $exibeDetalhes['nome_prod'];?></h1>
                        <p><?php echo $exibeDetalhes['desc_prod'];?>
                        </p>
                    </article>


                    <article class="produtos-preco mb-">
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
                        <strong">
                        <div class="price">R$<?php echo $exibeDetalhes['valor'];?></div>
                            <span class="d-block">Em até 12x sem Juros</span>
                        </strong>
                        
                        <form action="index.php?id=<?php echo $exibeDetalhes['id_prod']; ?>">
                            <div class="form-group">
                                <label for="produtos-quantidade-itens">Quantidade no estoque</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <?php  if($exibeDetalhes['quant_prod'] > 0) {
                                    for($x = 1; $x<=$exibeDetalhes['quant_prod']; $x++) {?>;
                                        <option><?php echo $n++;?></option>
                                    <?php } } else { ?>;
                                        <option><?php echo 0?></option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <?php if(!isset($_SESSION['ID'])) { ?>
                            <a href="login-funcionario.php">
                            <button type="button" class="btn btn-success col-md-12">Fazer login</button>
                            </a>
                            <?php }  else if($exibeDetalhes['quant_prod'] > 0) { ?>
                            <a href="Cart1.php?id=<?php echo $exibeDetalhes['id_prod']; ?>">
                            <button type="button" class="btn btn-success col-md-12">Comprar</button>
                            </a>
                            <?php } else { ?>
                            <button type="submit" class="btn btn-success col-md-12" disabled readonly="readonly">Indisponível</button> 
                            <?php } ?>   
                        </form>

                    </article>

                </section>
            </article>
        </div>
        </section>
</body>