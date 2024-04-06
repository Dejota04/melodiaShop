<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-insert.css"/>
    <title>Cadastrar funcionário</title>
    <script src="./assets/js/jquery.js"></script>
    <script src="jquery.mask.js"></script>

    <script>
	
	
	
    $(document).ready(function(){
        
        $("#cpf").mask("000.000.000-00");
        
    });
	
</script>
</head>
<body>

<?php
	ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();

	include 'conexao.php';	
	
	?>

    <section class="area-login">

        <!--tela de cadastro-->
       
    <div class="login">
        <div class="titulo">
            <p >Cadastrar Funcionário</p>
        </div>

        <form method="post" action="inserir-funcionário.php" >
            <input type="email" name="txtemail"  placeholder="insira o e-mail..." autofocus required id="txtemail"/>
            <input type="text" name="txtnome"  placeholder="insira o nome..." required id="txtnome"/>
            <input type="text" name="txtcpf"  placeholder="insira o cpf..." required id="cpf"/>
            <input type="password" name="txtsenha"  placeholder="senha..." required id="txtsenha"/>
            <input class="button" type="submit" name="submit" value="CADASTRAR" />
        </form>
        <a href="selecionar.php"><h3 class="voltar">Voltar</h3></a> 

        <?php

				 
					include 'conexao.php';
					$nome = $_POST['txtnome'];
					$email = $_POST['txtemail'];
					$senha = $_POST['txtsenha'];
					$cpf = $_POST['txtcpf'];

					$consultar = $cn->query("select cpf_func, email_func from funcionario where cpf_func='$cpf' or email_func='$email'");
					$exibe = $consultar->fetch(PDO::FETCH_ASSOC);

                    if($consultar->rowCount()>=1 && isset($_POST['submit']))
					{
						echo "<script lang='JavaScript'> window.alert('Esse funcionário já foi cadastrado!'); window.location.href='inserir-funcionário.php';</script>";
					} else if (isset($_POST['submit'])){

						$inserirFunc = $cn->query("insert into funcionario (nome_func, email_func, senha_func, CPF_func)
						values ('$nome','$email', '$senha', '$cpf')");    
						echo "<script lang='JavaScript'> window.alert('Funcionário cadastrado com sucesso!'); window.location.href='selecionar.php';</script>";
					}
?>
    </div>

    </section>

    
</body>
</html>