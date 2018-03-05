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
	<link rel="stylesheet" type="text/css" href="css/entrada.css">
<!--===============================================================================================-->
<script src="js/jquery-3.3.1.js"></script>
<script src="js/chained.js"></script>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="container-contact100">
		<div class="wrap-contact200" style="background-image: url('images/bg-01.jpg');">
			<div class="col">
				<div class="row">
					<button class="btn btn-primary mx-auto text-uppercase" style="width:95%" type="button" data-toggle="collapse" data-target="#collapseEntrada" aria-expanded="true" aria-controls="collapseEntrada">Entrada</button>
				</div>
				<div class="collapse" id="collapseEntrada">
					<div class="card card-body">
						<form autocomplete="off" class="contact100-form validate-form " id="entrada" name="entrada" method="post" action="entrada_insert.php">
							<span class="contact100-form-title">
								Entrada de Veículo
							</span>

							<label class="label-input100" for="placaentrada">Placa *</label>
							<div class="wrap-input100 " data-validate="Digite a placa">
								<input pattern="[A-Za-z]{3}-[0-9]{4}" title="Três letras e quatro números" required id="placaentrada" class="input100" type="text" name="placaentrada" placeholder="Ex:abc-1234">
								<span class="focus-input100"></span>
							</div>

							<div id="dadosentrada" name="dadosentrada" class="wrap-input100">
							</div>

							<label class="label-input100" for="sala">Sala *</label>
							<div class="wrap-input100" >
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

							<div class="container-contact100-form-btn" id='botaoentrada'>
								<button class="contact100-form-btn" onClick="return empty()">
									Registrar entrada
								</button>
							</div>
						</form>
					</div>

				</div>
			</div>

			<div class="col">
				<div class="row">
					<button class="btn btn-primary mx-auto text-uppercase" style="width:95%" type="button" data-toggle="collapse" data-target="#collapseSaida" aria-expanded="true" aria-controls="collapseSaida">Saída</button>
				</div>
				<div class="collapse" id="collapseSaida">
					<div class="card card-body">
						<form autocomplete="off" class="contact100-form validate-form" id="saida" name="saida" method="post" action="saida_insert.php">
							<span class="contact100-form-title">
								Saída de Veículo
							</span>

							<label class="label-input100" for="placa">Placa *</label>
							<div class="wrap-input100 " data-validate="Entre com a placa">
								<?php
									require 'conexao.php';
									$sql = "SELECT * FROM entrada where status = 0";
									$result = mysqli_query($conn,$sql);
									echo "<select class='form-control input100' required id ='placa' name='placa'>";
									echo "<option value=''>Selecione a placa</option>";
									while ($row = mysqli_fetch_array($result)) {
										echo "<option value='" . $row['id'] . "'>" . $row['placa'] . "</option>";
									}
									echo "</select>";

								?>
							</div>
							<div id="dados" name="dados" class="wrap-input100 ">
							</div>


							<div class="container-contact100-form-btn">
								<button class="contact100-form-btn">
									Registrar Saída
								</button>
							</div>
						</form>
					</div>
				</div>
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
		$('#collapseEntrada').collapse({
	  	toggle: true
		});

		$('#collapseSaida').collapse({
	  	toggle: true
		});

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

		//hide entrada
		$('#placa').on('change',function(){
			if ($(this).val()) {
				$("#collapseEntrada").collapse('hide');
				//$("#entrada").hide();
				//$("#dados").show();
			}
			else {
				$("#collapseEntrada").collapse('show');
				//$("#entrada").show();
				//$("#dados").hide();
			}
		});

		$('#entrada').submit(function()
		{
		    if ($.trim($("#MarcaEntrada").val()) === "" || $.trim($("#ModeloEntrada").val()) === "") {
		        alert('Por favor, aguarde os dados do veículo');
		    return false;
		    }
		});

		//hide saida
		$("#placaentrada").keyup(function () {
		   if ($(this).val()) {
				 $("#collapseSaida").collapse('hide');
		   	 //$("#saida").hide();
				 $("#dadosentrada").show();
		   }
		   else {
				 $("#collapseSaida").collapse('show');
		     //$("#saida").show();
				 $("#dadosentrada").hide();
				 $("#MarcaEntrada").val('');
				 $("#ModeloEntrada").val('');
		   }
		});

		document.getElementById("saida").style.display="block";

		document.getElementById("entrada").style.display="block";
			});

			function empty() {
		    var x;
		    x = document.getElementById("MarcaEntrada").value;
		    if (x == "Nao Encontrado") {
		        alert("Entre com uma placa válida");
		        return false;
		    };
				if (x == "") {
		        alert("Buscando veículo ...");
		        return false;
		    };
		}
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
