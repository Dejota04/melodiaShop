<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-login.css"/>
    <script src="./assets/js/jquery.js"></script>
    <title>Login-Funcionário</title>
</head>
<body>

<?php
	ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	include 'conexao.php';
    session_start();	

	
	?>
    <section class="area-login">

        <!--tela inicial de login-->
       
    <div class="login">
        <div>
            <img src="assets/images/logo 1.png">
        </div>

        <form name="form "method="post" action="login-funcionario.php">
            <input type="email" name="txtemail"  placeholder="E-mail..." autofocus required id="email"/>
            <input type="password" name="txtsenha"  placeholder="Senha..." required id="senha" />
            <input class="button" type="submit" name="submit" value="ENTRAR" />
            <a href="inserir-cliente.php" id="conta"><h4>Criar conta</h4></a> 
        <a href="index.php" class="voltar"><h4>Voltar</h4></a> 
        </form>

        <?php

            include 'conexao.php';
            session_start();
            $Vemail = $_POST['txtemail'];
            $Vsenha = $_POST['txtsenha'];

            $consultaF = $cn->query("select id_func, email_func, senha_func from funcionario where email_func = '$Vemail' and senha_func = '$Vsenha'");
            $consultaC = $cn->query("select id_cli, email_cli, senha_cli from cliente where email_cli = '$Vemail' and senha_cli = '$Vsenha'");

            if($consultaF-> rowCount() == 1)
            {
                $exibeFunc = $consultaF->fetch(PDO::FETCH_ASSOC);
                $_SESSION['ID'] = $exibeFunc['id_func'];
                header('Location:selecionar.php');
            }
            else if($consultaC-> rowCount() == 1)
            {
                $exibeCli = $consultaC->fetch(PDO::FETCH_ASSOC);
                $_SESSION['ID'] = $exibeCli['id_cli'];
                header('location:index.php');
            }
            else if (isset($_POST['submit'])) {
                echo "<script lang='JavaScript'> window.alert('Usuário Inexistente');</script>";
            }
            

            ?>
        
        
        
       
        
    </div>

    </section>
</body>
</html>