<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-insert.css"/>
    <title>Alterar conta</title>
    <script src="./assets/js/jquery.js"></script>
    <script src="jquery.mask.js"></script>

    <script>
	
	
	
    $(document).ready(function(){
        
        $("#cpf").mask("000.000.000-00");
        $("#tel").mask("(00)00000-0000");
        
        
    });
	
</script>
</head>
<body>

<?php
	
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();

    $id_cli = $_SESSION['ID'];
	include 'conexao.php';	
	

    $consulta = $cn->query("SELECT * FROM cliente WHERE id_cli='$id_cli'");	
	$exibe = $consulta->fetch(PDO::FETCH_ASSOC);

	?>

    <section class="area-login">

        <!--tela de cadastro-->
       
    <div class="login">
        <div class="titulo">
            <p ><b>Alterar Conta</b></p>
        </div>

        <form method="post" action="editar-cliente.php?id=<?php echo $exibe['id_cli'];?>" >
            <input type="email" name="txtemail"  placeholder="insira o e-mail..." value="<?php echo $exibe['email_cli']?>" autofocus required id="txtemail"/>
            <input type="text" name="txtnome"  placeholder="insira o nome..." value="<?php echo $exibe['nome_cli']?>" required id="txtnome">
            <input type="text" name="txtcpf"  placeholder="insira o cpf..." value="<?php echo $exibe['CPF_cli']?>" required id="cpf"/>
            <input type="text" name="txtTel"  placeholder="insira o telefone..." value="<?php echo $exibe['tel_cli']?>" required id="tel"/>
            <input type="password" name="txtsenha"  placeholder="senha..." value="<?php echo $exibe['senha_cli']?>" required id="txtsenha"/>
            <input class="button" type="submit" name="submit" value="EDITAR" />
        </form>
        <a href="areaCliente.php"><h3 class="voltar">Voltar</h3></a> 

        <?php

				 try{
					include 'conexao.php';
					$nome = $_POST['txtnome'];
					$email = $_POST['txtemail'];
					$telefone = $_POST['txtTel'];
					$cpf = $_POST['txtcpf'];
                    $senha = $_POST['txtsenha'];

					
					if (isset($_POST['submit'])){

						

                        $alterar = $cn->query("UPDATE cliente SET  
	
                            nome_cli = '$nome',
                            email_cli = '$email',
                            CPF_cli = '$cpf',
                            senha_cli = '$senha',
                            tel_cli = '$telefone'
                            
                            WHERE id_cli = '$id_cli' 	
                            ");

						   
						echo "<script lang='JavaScript'> window.alert('Conta alterada com sucesso!'); window.location.href='areaCliente.php';</script>";
                    }}
                    catch(PDOException $e) {  // se exsitir algum problema, será gerado uma mensagem de erro
	
	
                        echo $e->getMessage();  
                        
                    }
?>
    </div>

    </section>

    
</body>
</html>