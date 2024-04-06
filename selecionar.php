<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-selecionar.css"/>
    <title>Menu</title>
</head>
<body>

<?php
	ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

	include 'conexao.php';	
    session_start();
    if(empty($_SESSION['ID']))
	{
		header("location:index.php");
	}
	
	
	?>

    <section class="area-login">

        <!--tela de seleção-->
       
    <div class="login">
        <div>
            <img src="logo branca.png">
        </div>

        <form>
            <a href="inserir-funcionário.php"> <input class="button" type="button" name="insert-func" value="Inserir funcionário"/></a>
            <a href="inserir-cliente.php"></ahref><input class="button" type="button" name="Insert-cli" value="Inserir cliente"  /> </a>
            <a href="crud-busca.php"><input class="button" type="button" name="Insert-prod" value="Inserir/pesquisar produto"  /></a>
            <a href="inserir-forn.php"><input class="button" type="button" name="insert-forn" value="Inserir fornecedor" /></a>
        </form>
        <a href="sair.php"><h4 class="voltar">Logoff</h4></a> 
    </div>
    </section>
</body>
</html>