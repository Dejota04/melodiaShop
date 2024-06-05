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
	
	
    include 'conexao.php';
    session_start(); // iniciando sessão
	
	// verificando se usuário está logado
	if(empty($_SESSION['ID'])){
		
		header('location:login-funcionario.php'); // enviando para formlogon.php
		
	}

    $consultaCart = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where cart_prod= 1 ");
    $idCli = $_SESSION['ID'] ;
    $consultaCli = $cn->query("select nome_cli from cliente where id_cli = '$idCli'");
    $exibeCli = $consultaCli->fetch(PDO::FETCH_ASSOC);
    $valorTotal = $cn->query("select Sum(valor) as valor from produto where cart_prod = 1");
    $exibeTotal = $valorTotal->fetch(PDO::FETCH_ASSOC);


	
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

                    
                    </li>
                </ul>
                
                <!-- fim login funcionario -->
            </article>
            <!-- Fim Row -->
        </section>
        <!-- Fim Container -->
    </header>
    <!-- Fim do Header -->

	
    <h1 class="text-center">Carrinho</h1>
<?php  while($exibe = $consultaCart->fetch(PDO::FETCH_ASSOC)){ ?>
<div class="row align-items-center" style="margin-top: 30px;  margin-left: 200px;">
    
    <div class="col-sm-2 col-md-offset-3"><img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"></div>
    <div class="col-sm-4"><b><?php echo $exibe['nome_prod']; ?></b></div>
    <div class="col-sm-2"><b >R$ <?php echo $exibe['valor']; ?></b></div>
    <div class="col-sm-2 col-xs-offset-right-1">
    


<a href="excluir2.php?id=<?php echo $exibe['id_prod']; ?>">
    <button type="submit" class="btn btn-success col-md-6">Excluir</button>
    <span class="glyphicon glyphicon-info-sign"> </span>
    
  
            
    </button>
    </a>
    
    
    </div> 
            
</div>		
<hr>
<?php  } ?>
	
	
	<?php
	
	include 'footer.php';
	
	?>
	
</body>
</html>