<?php
	session_start();
	if (isset($_SESSION['url'])) {
		if (isset($_SESSION['user_role_id']) && ($_SESSION['user_role_id']=="1")) {
			$_SESSION['url'] = $_SERVER['REQUEST_URI'];
		}else {
			header("location: " .$_SESSION['url']);
		}
	}else {
		header("location: index.php");
	}
 ?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Registrar Usuário</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/caricon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body>
	<?php
	include 'header.php';
	?>

	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="post" action="registrar_insert.php">
				<span class="contact100-form-title">
					Cadastro de Usuário
				</span>

				<label class="label-input100" for="name">Nome *</label>
				<div class="wrap-input100 " data-validate="Digite seu nome completo">
					<input title="Insira um nome válido" required id="name" class="input100" type="text" name="name" placeholder="Golden Arch Edifício Empresarial">
					<span class="focus-input100"></span>
				</div>
				<label class="label-input100" for="placa">Matricula *</label>
				<div class="wrap-input100 " data-validate="Digite a matricula">
					<input title="Insira um numero de matricula valido" required id="matricula" class="input100" type="text" name="matricula" placeholder="123456789">
					<span class="focus-input100"></span>
				</div>
				<label class="label-input100" for="username">Nome de usuário *</label>
				<div class="wrap-input100 " data-validate="Digite um nome de usuario">
					<input title="Insira um nome válido" required id="username" class="input100" type="text" name="username" placeholder="Ex:Golden_Arch34">
					<span class="focus-input100"></span>
				</div>
				<label class="label-input100" for="password">Senha *</label>
				<div class="wrap-input100 " data-validate="Digite uma senha">
					<input title="Insira uma senha" required id="password" class="input100" type="password" name="password" placeholder="Senha">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="Confirmarpassword">Confirmar Senha *</label>
				<div class="wrap-input100 " data-validate="Repita a senha">
					<input title="Repita a senha" required id="Confirmarpassword" class="input100" type="password" name="Confirmarpassword" placeholder="Repetir Senha">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="password">CPF *</label>
				<div class="wrap-input100 " data-validate="CPF">
					<input title="CPF" required id="cpf" class="input100" type="text" name="cpf" placeholder="CPF">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="marca">Função *</label>
				<div class="wrap-input100 validate-input" data-validate = "Escolha a função">

						<select required class='form-control input100' id ='role' name='role'>
						<option value='1'>Administrador</option>
						<option value='2'>Moderador</option>
						<option value='3'>Garagista</option>
					  </select>

				</div>


				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						Registrar Usuário
					</button>
				</div>
			</form>

			<div class="contact100-more flex-col-c-m" style="background-image: url('images/bg-01.jpg');">
			</div>
		</div>
	</div>

<!--===============================================================================================-->
<script>
var password = document.getElementById("password")
	, confirm_password = document.getElementById("Confirmarpassword");

function validatePassword(){
	if(password.value != confirm_password.value) {
		confirm_password.setCustomValidity("As senhas não coincidem");
	} else {
		confirm_password.setCustomValidity('');
	}
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
</body>
</html>
