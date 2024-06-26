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


    $ticket= $_GET['ticket'];
    $cd_cliente = $_SESSION['ID'];
    $consultaCart = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where cart_prod= 1 ");
    $idCli = $_SESSION['ID'] ;
    $consultaCli = $cn->query("select nome_cli, email_cli, tel_cli from cliente where id_cli = '$idCli'");
    $exibeCli = $consultaCli->fetch(PDO::FETCH_ASSOC);
    $consultaVenda = $cn->query("select * from vw_venda where no_ticket = '$ticket' order by dt_venda desc;");
    $valorTotal = $cn->query("select Sum(valor_venda) as valor from vw_venda where no_ticket ='$ticket'");
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
                        <a href="sair.php">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            Logoff
                        </a> 
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
                                <?php if (isset($_SESSION['ID'])){?> 
                                <div class="total">
                                    <div class="total-title">Total</div>
                                    <div class="total-price">R$<?php echo $exibeTotal['valor'];?></div>
                                </div>
                            <a href="Carrinho.php">   
                                <button type="button" class="btn btn-success col-md-12 finaliza">Finalizar compra</button>
                            </a>
                            <?php } else{?>
                                <p>É necessário <a href="login-funcionario.php" id="msg"><b>fazer login</b></a> para utilizar o carrinho</p>
                            <?php }?>
                           

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


                <section class="container">
                    <h2 class="text-center conta"><b>Minha conta</b></h2><br><br> 
                    <h4><b>Dados</b></h4><hr>
                        <article class="dados conta">
                            <nav class="row d-flex justify-content-between">
                                <p class="col-md-2  d-flex conta"><b>Dados Pessoais</b></p>
                                <a class="col-md-2  d-flex conta" href="editar-cliente.php"><p><b>Alterar</b></p></a>
                            </nav>
                            <hr>

                            <p><b>Nome:</b> <?php echo $exibeCli['nome_cli'];?></p>
                            <p><b>Email:</b> <?php echo $exibeCli['email_cli'];?></p>
                            <p><b>Telefone:</b> <?php echo $exibeCli['tel_cli'];?></p>

                                
                        
                        </article>

                </section>

                <div class="container-fluid">
        </nav>
	
        
        <section class="container produtos">
                    <h4><b>Compras realizadas</b></h4><hr>
        
        <article class="compras">
	<div class="text-center row d-flex justify-content-between" style="margin-top: 15px;">
		
		<div class="col-sm-2 col-md-offset-3"> <b>Data</b> </div>
		<div class="col-sm-2"> <b>Ticket</b> </div>
		<div class="col-sm-2"> <b>Produto</b> </div>
		<div class="col-sm-2"> <b>Quantidade</b> </div>
		<div class="col-sm-2"> <b>Preço</b> </div>
				
	</div>		

    <?php while($exibeVen = $consultaVenda->fetch(PDO::FETCH_ASSOC)){?>
    <div class="text-center row d-flex justify-content-between" style="margin-top: 15px;">
		
		<div class="col-sm-2 col-md-offset-3"> <?php echo date('d/m/Y', strtotime($exibeVen['dt_venda']))?></div>
		<div class="col-sm-2" href=""> <?php echo $exibeVen['no_ticket']?> </div>
		<div class="col-sm-2"> <?php echo $exibeVen['nome_prod']?> </div>
		<div class="col-sm-2"> <?php echo $exibeVen['qt_prod']?> </div>
		<div class="col-sm-2"> R$<?php echo number_format ($exibeVen['valor_venda'], 2, ',','.')?> </div>
        

				
	</div>		
	<?php } ?>
    <hr>
        <div class="text-center row d-flex justify-content-center">
            <div class="col-sm-2"> <b>Total:</b> R$<?php echo number_format ($exibeTotal['valor'], 2, ',','.')?> </div>
        </div>
    <br>
        <div class="text-center row d-flex justify-content-center">
            <div class="col-sm-2"> <a href="areaCliente.php"<b>Voltar</b></a> 
        </div>
    </article>
	</section>
</div>

	<!-- Footer -->
    <footer class="container-fluid-cart">
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
                        <li class="nav-item">
                        <a href="https://www.instagram.com/me_lodia_shop?igsh=d3Rndmx2N2p5NnRq" target="_blank">Nosso Instagram</a>
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

    <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
<a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=11949081179&text=Ol%C3%A1,%20Gostaria%20de%20conhecer%20mais%20sobre%20a%20loja!">
  <div class="rwb-tooltip">Fale conosco</div>
  <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
</a>


</body>



</html>