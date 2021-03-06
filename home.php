<?php
	session_start();
	if (isset($_SESSION['url'])) {
		if (isset($_SESSION['user_role_id'])) {
			$_SESSION['url'] = $_SERVER['REQUEST_URI'];
		}else {
			header("location: " .$_SESSION['url']);
		}
	}else {
		header("location: index.php");
	}
 ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Home</title>

	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/agency.css" rel="stylesheet">
</head>
<body class="masthead">
	<?php include 'header.php';
	date_default_timezone_set('America/Sao_Paulo');
	 ?>
		<div class="container">
			<div class="intro-text">
				<div class="intro-lead-in"> Hoje é <?php echo date("d/m/Y")?></div>
				<div class="intro-heading text-uppercase">Bem-Vindo <?php echo $_SESSION['user_name'];?></div>
				 <div class="btn-group-vertical btn-group-lg">
					 <div class="btn-group btn-group-lg mb-2">
						 <?php
  					 	if ($_SESSION['user_role_id'] == '1') {
  					 		echo '<a class="btn btn-primary text-uppercase js-scroll-trigger" href="registrar.php">Registrar Usuário</a>
								<a class="btn btn-primary text-uppercase js-scroll-trigger" href="alterar.php">Alterar Usuário</a>
  							<a class="btn btn-primary text-uppercase js-scroll-trigger rounded-right" href="remover.php">Remover Usuário</a>';
  					 	}
  						?>
					 </div>
					 <div class="btn-group btn-group-lg mb-2">
					   <?php
						 	if ($_SESSION['user_role_id'] == '1' || $_SESSION['user_role_id'] == '2') {
							  echo '<a class="btn btn-primary text-uppercase js-scroll-trigger rounded-left" href="relatorio.php">Relatórios</a>
								<a class="btn btn-primary text-uppercase js-scroll-trigger rounded-right" href="alterar_saida.php">Saída Manual</a>';
						 	}
						?>
					</div>
					<?php
 						if ($_SESSION['user_role_id'] == '1' || $_SESSION['user_role_id'] == '3') {
 							echo '<a class="btn btn-primary text-uppercase js-scroll-trigger rounded" href="entrada.php">Registrar Entrada/Saida</a>';
 						}
 					 ?>
				 </div>
			</div>
		</div>

</body>
</html>
