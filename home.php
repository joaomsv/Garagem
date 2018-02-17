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
<!DOCTYPE html>
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
	<?php include 'header.php' ?>
		<div class="container">
			<div class="intro-text">
				<div class="intro-lead-in"> Hoje é <?php date_default_timezone_set('America/Sao_Paulo'); echo date("d/m/Y")?></div>
				<div class="intro-heading text-uppercase">Bem-Vindo <?php echo $_SESSION['user_name'];?></div>
				 <div class="btn-group btn-group-lg">
					 <?php
					 if ($_SESSION['user_role_id'] == '1') {
					 	echo '<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="registrar.php">Registrar Usuário</a>
						<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="remover.php">Remover Usuário</a>';
					 }
 						if ($_SESSION['user_role_id'] == '1' || $_SESSION['user_role_id'] == '3') {
 							echo '<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="entrada.php">Registrar Entrada</a>
 							<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="saida.php">Registrar Saída</a>';
 						}
 						if ($_SESSION['user_role_id'] == '1' || $_SESSION['user_role_id'] == '2') {
 							echo '<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="relatorio.php">Relatórios</a>';
 						}
 					 ?>
				 </div>
			</div>
		</div>

</body>
</html>
