<?php
	session_start();
	if (isset($_SESSION['url'])) {
		if (isset($_SESSION['user_role_id']) && ($_SESSION['user_role_id']=="1" || $_SESSION['user_role_id']=="3")) {
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
	<title>Registrar Entrada</title>
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
<script src="js/jquery-3.3.1.js"></script>
<script src="js/chained.js"></script>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="post" action="entrada_insert.php">
				<span class="contact100-form-title">
					Entrada de Veículo
				</span>

				<label class="label-input100" for="placaentrada">Placa *</label>
				<div class="wrap-input100 " data-validate="Digite a placa">
					<input title="Três letras e quatro números" required id="placaentrada" class="input100" type="text" name="placaentrada" placeholder="Ex:abc-1234">
					<span class="focus-input100"></span>
				</div>

				<div id="dados" name="dados" class="wrap-input100 ">
				</div>

				<label class="label-input100" for="sala">Sala *</label>
				<div class="wrap-input100 validate-input" data-validate = "Selecione a sala">
					<?php
						require 'conexao.php';
						$sql = "SELECT * FROM salas";
						$result = mysqli_query($conn,$sql);
						echo "<select required class='form-control input100' name='Sala'>";
						echo "<option value=''>Selecione a sala</option>";
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='" . $row['sala'] . "'>" . $row['sala'] . "</option>";
						}
						echo "</select>";

					?>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						Registrar entrada
					</button>
				</div>
			</form>

			<div class="contact100-more flex-col-c-m" style="background-image: url('images/bg-01.jpg');">
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/jquery.mask.js"></script>

	<script>
	$(document).ready(function(){
  $('#placaentrada').mask('SSS-0000', {
            'translation': {
                S: {pattern: /[A-Za-z]/},
                0: {pattern: /[0-9]/}
            }
            ,onKeyPress: function (value, event) {
                event.currentTarget.value = value.toUpperCase();
            }
});
	});
	</script>
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
