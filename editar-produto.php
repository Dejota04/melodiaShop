<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="alterar-prod.css"/>
    <script src="./assets/js/jquery.js"></script>
    <script src="jquery.mask.js"></script>
    <title>Editar Produto</title>

    <script>
	
	
	
$(document).ready(function(){
	
$('#preco').mask('000.000.000.000.000,00', {reverse: true});
	
});
	
</script>

</head>
<body>
<?php
	ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

	
		
	
	session_start();
	if(empty($_SESSION['ID']))
	{
		header("location:index.php");
	}
	
	
	$id_prod = $_GET['id'];

	
	
	include 'conexao.php';	
	
	
	$consulta = $cn->query("SELECT * FROM produto WHERE id_prod='$id_prod'");	
	$exibe = $consulta->fetch(PDO::FETCH_ASSOC);
	
	
	?>
    <section class="area-login">

        <!--tela de cadastro produto-->
       
    <div class="login">
        <div>
            <p class="titulo">Editar Produto</p>
        </div>

        <form method="post" action="editar-produto.php?id=<?php echo $exibe['id_prod'];?>" enctype="multipart/form-data">

            <input type="text" name="txtprod" value="<?php echo $exibe['nome_prod']; ?>" placeholder="Nome do produto..." required id="txtprod"/>

            <select class="form-control" name="sltcat">
					  <option value="<?php echo $exibe['categoria']; ?>"><?php echo $exibe['categoria']; ?></option>
                      <option value=""></option>
					  <option value="Guitarra">Guitarra</option>
					  <option value="Violao">Violão</option>
					  <option value="Violino">Violino</option>
					  <option value="Bateria">Bateria</option>
					  <option value="Teclado">Teclado</option>
					  <option value="Piano">Piano</option>
					  <option value="Saxofone">Saxofone</option>					
					</select>

            <input type="text" name="txtpreco"  placeholder="Preço" value="<?php echo $exibe['valor']; ?>" required id="preco"/>

            <input type="number" name="txtqtd"  placeholder="Quantidade..." value="<?php echo $exibe['quant_prod']; ?>" required id="txtqtd"/>

            <br/>
            <h2 >descrição</h2>
            <textarea class="area" rows="5" name="txtdesc"><?php echo $exibe['desc_prod']; ?></textarea>

            <input type="file" accept="image/*" class="form-control" name="txtfoto1" id="foto1">
            
            <img src="./assets/images/<?php echo $exibe['img_prod']; ?>" width="100px" >
            	

            <input class="button" type="submit" name="submit" value="ALTERAR" />
         <a href="crud-busca.php"><h3 class="voltar">voltar</h3></a> 
        </form>

        <?php
session_start();
if(empty($_SESSION['ID']))
{
    header("location:index.php");
}
if(isset($_POST['submit'])){
include 'conexao.php';  // incluindo a conexao
include 'resize-class.php'; // classe para redimensionar imagem

$id_prod = $_GET['id'];  // variavel recebe o código do livro que acabamos de receber do formulário

// abaixo criando a consulta pelo codigo do livro que recebemos acima
$consulta = $cn->query("SELECT img_prod FROM produto WHERE id_prod='$id_prod'"); 

//criando uma array 
$exibe = $consulta->fetch(PDO::FETCH_ASSOC);


// todas as laterações feitas nos campos serão salvas nas variaveis abaixo

$nome = $_POST['txtprod'];  // armazenando o valor do txtisbn na variavel $isbn 
$categoria = $_POST['sltcat'];  // armazenando o valor de sltcat na variavel $categoria
$valor = $_POST['txtpreco'];
$desc = $_POST['txtdesc'];
$qtd = $_POST['txtqtd'];



$remover1='.';  // variável que vai receber o ponto
$valor = str_replace($remover1, '', $valor); // substituindo . por vazio
$remover2=','; // variável que vai receber a virgula
$valor = str_replace($remover2, '.', $valor); // substituindo , por .

$recebe_foto1 = $_FILES['txtfoto1'];  // recebendo conteudo do campo file


$destino = "./assets/images/";  //pasta aonde será feito upload da imagem


if (!empty($recebe_foto1['name'])) { // se a propriedade name[propriedade que pega o nome da imagem ] não estiver vazia faça

	preg_match("/\.(jpg|jpeg|png|gif){1}$/i",$recebe_foto1['name'],$extencao1); // pegar extensão
	$img_nome1 = md5(uniqid(time())).".".$extencao1[1]; //gerar nome unico para img, enviar esta variável

	$upload_foto1=1; // se variavel criada for 1 precisará trocar imagem

}

else {  // caso não haja alteração na imagem, pegar o nome da imagem que está no banco
	
	$img_nome1=$exibe['img_prod'];
	$upload_foto1=0;  // zero pq não fará atualização de fotos
	
}
	

try {
	// comando update para realizar as trocas
	$alterar = $cn->query("UPDATE produto SET  
	
	nome_prod = '$nome',
	categoria = '$categoria',
	valor = '$valor',
	quant_prod = '$qtd',
	desc_prod = '$desc',
	img_prod = '$img_nome1'	
	
	WHERE id_prod = '$id_prod' 	
	 "); // as alterações serão feitas baseadas pelo codigo que recebemos
	
	
	if ($upload_foto1==1) {  // se a foto1 for igual a 1 é pq foi feito alteração será feita
		
		
		move_uploaded_file($recebe_foto1['tmp_name'], $destino.$img_nome1);             
		$resizeObj = new resize($destino.$img_nome1);
		$resizeObj -> resizeImage(250, 250, 'crop');
		$resizeObj -> saveImage($destino.$img_nome1, 100);
		
	}
	
	header('location:crud-busca.php');  // redirecionando para a pagina menu principal (se tudo der certo)
	
} catch(PDOException $e) {  // se exsitir algum problema, será gerado uma mensagem de erro
	
	
	echo $e->getMessage();  
	
}
}


?>
    </div>

    </section>
</body>
</html>