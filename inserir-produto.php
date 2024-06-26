<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-produto.css"/>
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
    <section class="area-login">

        <!--tela de cadastro produto-->
       
    <div class="login">
        <div>
            <p class="titulo">Cadastrar Produto</p>
        </div>

        <form method="post" action="inserir-produto.php" enctype="multipart/form-data">

            <input type="text" name="txtprod"  placeholder="Nome do produto..." required id="txtprod"/>

            <select class="form-control" name="sltcat">
					  <option value="">Categoria</option>
					  <option value="Guitarra">Guitarra</option>
					  <option value="Violao">Violão</option>
					  <option value="Violino">Violino</option>
					  <option value="Bateria">Bateria</option>
					  <option value="Teclado">Teclado</option>
                      <option value="Piano">Piano</option>
					  <option value="Saxofone">Saxofone</option>					
					</select>

            <input type="text" name="txtpreco"  placeholder="Preço" required id="preco"/>

            <input type="number" name="txtqtd"  placeholder="Quantidade..." required id="txtqtd"/>

            <br/>
            <h2 >descrição</h2>
            <textarea class="area" rows="5" name="txtdesc"></textarea>

            <input type="file" accept="image/*" class="form-control" name="txtfoto1" required id="txtfoto1">


            <input class="button" type="submit" name="submit" value="CADASTRAR" />
         <a href="crud-busca.php"><h3 class="voltar">Voltar</h3></a> 
        </form>

        <?php
session_start();
if(empty($_SESSION['ID']))
{
    header("location:index.php");
}

if(isset($_POST['submit'])){
      
include 'conexao.php'; 
include 'resize-class.php';

//variáveis que vão receber os dados do formulário que esta na pagina formProduto
$nome_prod= $_POST['txtprod'];
$categoria = $_POST['sltcat']; // recebendo o valor do campo select, valor numérico
$preco = $_POST['txtpreco'];
$qtd = $_POST['txtqtd'];
$desc = $_POST['txtdesc'];

$remover1='.';  // criando variável e atribuindo o valor de ponto para ela
$preco = str_replace($remover1, '', $preco); // removendo ponto de casa decimal,substituindo por vazio
$remover2=','; // criando variável e atribuindo o valor de virgula para ela
$preco = str_replace($remover2, '.', $preco); // removendo virgula de casa decimal,substituindo por ponto

$recebe_foto1 = $_FILES['txtfoto1'];

$destino = "./assets/images/";  // informando para qual diretorio será enviado a imagem


//gerando nome aleatorio para imagem
// preg_match vai pegar imagens nas extensões jpg|jpeg|png|gif
// do nome que esta na variavel $recebe_foto1 do parametro name e a $extensão vai receber o formato
preg_match("/\.(jpg|jpeg|png|gif){1}$/i",$recebe_foto1['name'],$extencao1);

// a função md5 vai gerar um valor randomico  com base no horario "time"
// incrementar o ponto e a extensão
// função md5 é criado para gerar criptografia
$img_nome1 = md5(uniqid(time())).".".$extencao1[1];



	
	$inserir=$cn->query("INSERT INTO produto(nome_prod, categoria, valor, quant_prod, desc_prod, img_prod, cart_prod) VALUES ('$nome_prod', '$categoria', '$preco', '$qtd', '$desc', '$img_nome1', 0)");
	move_uploaded_file($recebe_foto1['tmp_name'], $destino.$img_nome1);             
    $resizeObj = new resize($destino.$img_nome1);
    $resizeObj -> resizeImage(250, 250, 'crop');
    $resizeObj -> saveImage($destino.$img_nome1, 100);
	

    echo "<script lang='JavaScript'> window.alert('Produto cadastrado com sucesso!'); window.location.href='crud-busca.php';</script>";
}


?>
    </div>

    </section>
</body>
</html>