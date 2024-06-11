

<?php
// iniciando a sessão, pois precisamos pegar o cd do usuario logado para salvar na tabela de vendas no campo cd_cliiente
session_start();  

include 'conexao.php';


$data = date('Y-m-d');  // variavel que vai pegar a data do dia (ano mes dia -padrão do mysql)
$ticket = uniqid();  // gerando um ticket com função uniqid(); 	gera um id unico    
$cd_user = $_SESSION['ID'];  //recebendo o codigo do usuário logado, nesta pagina o usuario ja esta logado pois, em do carrinho de compra

//// criando um loop para sessão carrinho q recebe o $cd e a quantidade
foreach ($_SESSION['carrinho'] as $cd => $qnt)  {
    $consulta = $conexao->query("SELECT valor FROM produto WHERE id_prod='$cd'");
    $exibe = $consulta->fetch(PDO::FETCH_ASSOC);
    $preco = $exibe['valor'];
    
	
	$inserir = $conexao->query("INSERT into venda(no_ticket, id_cli, id_prod, qt_prod, vl_prod, dt_venda)  VALUES
	('$ticket','$cd_user','$cd','$qnt','$preco','$data')");
	
}
?>


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
		
		header('location:login-cart.php'); // enviando para formlogon.php
		
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

	



    <?php include 'fim.php'; ?>

    <div class="text-center justify-content-around" id="botaoCarrinho">
        <a href="index.php">   
            <button type="button" class="btn btn-success col-md-3 finaliza">Voltar</button>
        </a>
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

	
</body>
</html>