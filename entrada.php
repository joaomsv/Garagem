
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact V17</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="post" action="entrada_insert.php">
				<span class="contact100-form-title">
					Entrada de Veículo
				</span>

				<label class="label-input100" for="placa">Placa *</label>
				<div class="wrap-input100 " data-validate="Type first name">
					<input title="Três letras e quatro números" required id="placa" class="input100" type="text" name="placa" pattern="[A-Za-z]{3}[0-9]{4}" placeholder="Ex:abc-1234">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="marca">Marca *</label>
				<div class="wrap-input100 validate-input" data-validate = "Selecione a marca">
					<?php 
						require 'conexao.php';
						$sql = "SELECT * FROM marcas"; 
						$result = mysqli_query($conn,$sql);
						echo "<select required class='form-control input100' id ='Marca' name='Marca'>";
						echo "<option value=''>Selecione a marca</option>";
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
						}
						echo "</select>";

					?>
				</div>

				<label class="label-input100" for="modelo">Modelo *</label>
				<div class="wrap-input100">
				<select required class='form-control input100' id='Modelo' name='Modelo'>
				<option value=''>Selecione a marca primeiro</option>
				</select>
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
				<div class="flex-w size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-map-marker"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Address
						</span>

						<span class="txt2">
							Mada Center 8th floor, 379 Hudson St, New York, NY 10018 US
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-phone-handset"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Lets Talk
						</span>

						<span class="txt3">
							+1 800 1236879
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-envelope"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							General Support
						</span>

						<span class="txt3">
							contact@example.com
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

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
