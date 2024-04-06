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
$pesquisa = $_GET['txtbusca'];
    

    $consulta = $cn->query("select * from produto where nome_prod like concat ('%','$pesquisa','%')");
   
	?>


  <div class="container">
    <div class="header">
      <h1 class="titulo2">Cadastro de Produtos</h1>
      <div class="add-bt">
    <a href="inserir-produto.php"><button id="add">Adicionar</i></button></a> 
    <a href="selecionar.php"><button id="add">inicio</i></button></a>
      </div>
      <form>
      <input type="text" name="txtbusca"  placeholder="digite o produto..." />
      <input class="button-pesquisar" type="submit" name="busca" value="BUSCAR" />
    </form>
    </div>
        <section class="container-fluid-produtos">
      </table>
      <?php while($exibe = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
      <section class="container-fluid-bd">
      <div class="divTablebd">
      <table class="table-prodbd">
        <thead class="prod-trbd">
          <tr>
            <th><div><img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid"></div></th>
            <th></th>
            <th><div><h4><?php echo $exibe['nome_prod']; ?></h4></div></th>
            <th><div><h4 >R$ <?php echo $exibe['valor']; ?></h4></div></th>
            <th><a href="editar-produto.php?id=<?php echo $exibe['id_prod']; ?>">
		        <button id="add" type="submit" >Alterar</button>
            <th class="acao"> <a href="excluir.php?id=<?php echo $exibe['id_prod']; ?>">
	        	<button id="add" type="submit" class="btn btn-success col-md-6">Excluir</button>

          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <?php  } ?>
	
  
      
				
		</button>
        </a>
		
		
		</div> 
				
	</div>		
	


	
    </div>
     
</body>

</html>