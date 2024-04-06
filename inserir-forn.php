<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-forn.css"/>
    <title>Cadastrar fornecedor</title>
    <script src="./assets/js/jquery.js"></script>
    <script src="jquery.mask.js"></script>

    <script>
	
	
	
    $(document).ready(function(){
        
        $("#cnpj").mask("99.999.999/9999-99");
        $("#tel").mask("(00) 00000-0000");
        
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
            <p >Cadastrar Fornecedor</p>
        </div>

        <form method="post" action="inserir-forn.php" >
            <input type="email" name="txtemail"  placeholder="insira o e-mail..." autofocus required id="txtemail"/>
            <input type="text" name="txtnome"  placeholder="insira o nome..." required id="txtnome"/>
            <input type="text" name="txtcnpj"  placeholder="insira o cnpj..." required id="cnpj"/>
            <input type="text" name="txtTel"  placeholder="insira o telefone..." required id="tel"/>
            <input class="button" type="submit" name="submit" value="CADASTRAR" />
        </form>
        <a href="selecionar.php"><h3 class="voltar">Voltar</h3></a> 

        <?php

				 
					include 'conexao.php';
					$nome = $_POST['txtnome'];
					$email = $_POST['txtemail'];
					$telefone = $_POST['txtTel'];
					$cnpj = $_POST['txtcnpj'];

					$consultar = $cn->query("select CNPJ_forn, email_forn from fornecedor where CNPJ_forn='$cnpj' or email_forn='$email'");
					$exibe = $consultar->fetch(PDO::FETCH_ASSOC);

                    if($consultar->rowCount()>=1 && isset($_POST['submit']))
					{
						echo "<script lang='JavaScript'> window.alert('Esse fornecedor já foi cadastrado!'); window.location.href='inserir-forn.php';</script>";
					} else if (isset($_POST['submit'])){

						$inserirFunc = $cn->query("insert into fornecedor (nome_forn, email_forn, CNPJ_forn)
						values ('$nome','$email', '$cnpj')");    
						echo "<script lang='JavaScript'> window.alert('Fornecedor cadastrado com sucesso!'); window.location.href='selecionar.php';</script>";
					}
?>
    </div>

    </section>

    
</body>
</html>