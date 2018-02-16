
<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Relatório</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/relicon.png"/>
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
	include 'header.html';
	?>
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" id="relatorio" name="relatorio" method="post" action="mostrar_relatorio.php">
				<span class="contact100-form-title">
					Relatório de Entrada e Saída
				</span>

				<label class="label-input100" for="placa">Ano *</label>
				<div class="wrap-input100 " data-validate="Type first name">
					<?php
						require 'conexao.php';
						$sql = "SELECT DISTINCT YEAR(data_hora_saida) FROM `entrada` WHERE status = 1";
						$result = mysqli_query($conn,$sql);
						echo "<select required class='form-control input100' id ='ano' name='ano'>";
						echo "<option value=''>Selecione o ano</option>";
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='" . $row['YEAR(data_hora_saida)'] . "'>" . $row['YEAR(data_hora_saida)'] . "</option>";
						}
						echo "</select>";

					?>
				</div>

				<select required class='form-control input100' id='mes' name='mes'>
				<option value=''>--</option>
				</select>
				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						Gerar Relatório
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
