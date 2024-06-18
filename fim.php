
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->

    <title>MelodiaShop</title>
    <link rel="stylesheet" href="./assets/scss/style.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">


	
	
</style>
	
	
</head>

<body>
	
<?php
	
	include 'conexao.php';	

	
	?>
	
	
	<div class="container-fluid fim">
	
			<div class="col-sm-4 col-sm-offset-4 text-center">
				
				<h2>Compra efetuada com sucesso!! Seu número de registro é: <?php echo $ticket; ?></h2>				
							
			</div>
		
	</div>
	
	<div class="container-fluid ">
	<a href="index.php">   
            <button type="button" class="btn btn-success col-md-3 botao">Voltar</button>
        </a>
	</div>
	
	
	
	
</body>
</html>