<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link rel="stylesheet" href="style-crud.css">
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
$consulta = $cn->query("select * from produto");

?>
  <div class="container">
    <div class="header">
      <h1 class="titulo2">Cadastro de Produtos</h1>
      <div class="add-bt">
    <a href="inserir-produto.php"><button id="add">Adicionar</i></button></a> 
    <a href="editar-produto.php"><button id="add">Editar</i></button></a>
    <a href="selecionar.php"><button id="add">inicio</i></button></a>
      </div>
      <form>
      <input type="text" name="pesquisar"  placeholder="digite o produto..." />
      <input class="button-pesquisar" type="submit" name="busca" value="BUSCAR" />
    </form>
    </div>

    <div class="divTable">
      <table class="table-prod">
        <thead class="prod-tr">
          <tr>
            <th>imagem</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th class="acao">Editar</th>
            <th class="acao">Excluir</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

      <section class="container-fluid produtos">

	
  
	<?php while($exibe = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>

	<div class="row align-items-center" style="margin-top: 30px;  margin-left: 200px;">
		
		<div class="col-sm-1 col-sm-offset-1"><img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"></div>
		<div class="col-sm-5"><h4><?php echo $exibe['nome_prod']; ?></h4></div>
		<div class="col-sm-2"><h4 >R$ <?php echo $exibe['valor']; ?></h4></div>
		<div class="col-sm-2 col-xs-offset-right-1">
        
    <a href="editar-produto.php?id=<?php echo $exibe['id_prod']; ?>">
		<button type="submit" class="btn btn-success col-md-6">Alterar</button>
		<span class="glyphicon glyphicon-info-sign"> </span>

    <a href="excluir.php?id=<?php echo $exibe['id_prod']; ?>">
		<button type="submit" class="btn btn-success col-md-6">Excluir</button>
		<span class="glyphicon glyphicon-info-sign"> </span>
		
      
				
		</button>
        </a>
		
		
		</div> 
				
	</div>		
	
	<?php  } ?>

	
</div>
    </div>
     
</body>

</html>