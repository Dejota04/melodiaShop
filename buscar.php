<!doctype html>

<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Minha Loja</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="./assets/scss/style.css">
	
</head>

<body>	
	
	<?php
	
	
	include 'conexao.php';
   
    
    $pesquisar = $_GET['txtbuscar'];
    if(empty($_GET['txtbuscar']))
    {
        echo "<script lang='JavaScript'> window.alert('Digite o nome de um produto!');</script>";
		header('location:index.php');
    }

    $consulta = $cn->query("select * from produto where nome_prod like concat ('%','$pesquisar','%')");
    if($consulta->rowCount() == 0)
    {
        echo "<script lang='JavaScript'> window.alert('Este produto não existe!');</script>";
		header('location:index.php');
    }
	?>
	


	<section class="container resultados ">
            <!-- Guitarras -->
            <h1 class="text-center " id="guitarra">Resultados</h1>
            <!-- Listagem dos Produtos -->
            <article class="row resultados">
            <?php while($exibe = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                <!-- Produtos 1 -->
                <a href="index.php?id=<?php echo $exibe['id_prod']; ?>" class="resultados-container col-md-3">
                    <!-- Imagem do Produto -->
                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid">
                    <!-- Itens do Produto -->
                    <article class="resultados-itens">
                        <!-- Nome do Produto -->
                        <h2><?php echo $exibe['nome_prod']; ?></h2>
                        <!-- Estrelas do Produto -->
                        <div class="resultados-stars">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>

                        </div>
                        <!-- Preço do Produto -->
                        <strong class="resultados-preco">
                        R$ <?php echo $exibe['valor']; ?>
                        </strong>
						<button type="submit" class="btn btn-success col-md-12">Detalhes</button>
                    </article>
                    <!-- Fim Itens do Produto -->
                </a>
                <?php } ?>
                <!-- Fim Produtos -->
            </article>
            <!-- Fim Listagem dos Produtos -->






	
</div>





	
</body>
</html>