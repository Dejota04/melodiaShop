<?php 
	
	
	session_start();
	
	
	
	$id_prod = $_GET['id'];

	
	
	
	include 'conexao.php';	
	
	
	$consulta = $cn->query("SELECT * FROM produto WHERE id_prod='$id_prod'");	
	$exibe = $consulta->fetch(PDO::FETCH_ASSOC);

    $alterar = $cn->query("update produto set cart_prod = 1 where id_prod = $id_prod;");
    header("location:index.php")

    
     ?>