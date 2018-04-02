<?php
    session_start();
    if (isset($_SESSION['url'])) {
        if (isset($_SESSION['user_role_id']) && ($_SESSION['user_role_id']=="1" || $_SESSION['user_role_id']=="2")) {
            $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        } else {
            header("location: " .$_SESSION['url']);
        }
    } else {
        header("location: index.php");
    }
 ?>
<html lang="pt">
<head>
	<title>Saída Manual</title>
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
		<div class="wrap-contact200" style="background-image: url('images/predio01.jpg'); background-size: cover;">
			<div class="col">
				<div class="row" style="width:97%">
					<div class="btn-group btn-group-justified btn-group-toggle" data-toggle="buttons" id="rad-saida">
						<label class="btn btn-secondary active" id="btn-barcode">
							<input type="radio" name="options" checked> Codigo de Barra
						</label>
						<label class="btn btn-secondary" id="list">
							<input type="radio" name="options"> Lista de Placa
						</label>
					</div>
				</div>

					<div class="card card-body">
						<form autocomplete="off" class="contact100-form validate-form" id="saida" name="saida" method="post" action="alterar_saida_update.php">
							<span class="contact100-form-title">
								Saída Fora do Horário
							</span>
							<label class="label-input100" for="horamodificada">Data e Hora de saída *</label>
							<div class="wrap-input100 " data-validate="Digite a data e hora de saída">
								<input  title="Data e Hora" required id="hora_saida" class="input100" type="text" name="hora_saida" placeholder="Ex:01/01/2018 20:00:00">
								<span class="focus-input100"></span>
							</div>

							<label class="label-input100" for="Ano">Ano *</label>
							<div class="wrap-input100 " data-validate="Entre com o Ano">
								<?php
                  require 'conexao.php';
                  $sql = "SELECT DISTINCT YEAR(data_hora_saida) FROM `entrada` WHERE 1";
                  $result = mysqli_query($conn, $sql);
                  echo "<select required class='form-control input100' id ='ano' name='ano'>";
                  echo "<option value=''>Selecione o ano</option>";
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['YEAR(data_hora_saida)'] . "'>" . $row['YEAR(data_hora_saida)'] . "</option>";
                  }
                  echo "</select>";
                ?>
							</div>

							<label class="label-input100" for="Sala">Sala *</label>
							<select required class='form-control input100' id='salarelatorio' name='salarelatorio'>
							<option value=1>Selecione uma sala</option>
							</select>

							<label class="label-input100" for="Mes">Mes *</label>
							<select required class='form-control input100' id='mes' name='mes'>
							<option value=''>Selecione um Mês</option>
							</select>

							<label class="label-input100" for="Dia">Dia *</label>
							<select required class='form-control input100' id='dia' name='dia'>
							<option value=''>Selecione um Dia</option>
							</select>

							<label class="label-input100" for="Placa">Placa *</label>
							<select required class='form-control input100' id='placa_saida' name='placa_saida'>
							<option value=''>Esperando informações ...</option>
							</select>

							<div class="container-contact100-form-btn">
								<button class="contact100-form-btn">
									Alterar Hora de Saída
								</button>
							</div>
						</form>
						<form class="contact100-form validate-form" id="barcode-saida" action="alterar_saida_update.php" method="post">
							<span class="contact100-form-title">Saída Fora do Horário</span>

							<label class="label-input100" for="horamodificada">Data e Hora de saída *</label>
							<div class="wrap-input100 " data-validate="Digite a data e hora de saída">
								<input  title="Data e Hora" required id="horasaida" class="input100" type="text" name="horasaida" placeholder="Ex:01/01/2018 20:00:00">
								<span class="focus-input100"></span>
							</div>
							<label class="label-input100" for="barcode">Código de Barras</label>
							<div class="wrap-input100">
								<input required id="barcode" class="input100" type="text" name="barcode">
								<span class="focus-input100"></span>
						</div>

						<div class="container-contact100-form-btn">
							<button class="contact100-form-btn">
								Registar Saída
							</button>
						</div>
					</form>
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

	<script >
		$('#collapseSaida').collapse({
			toggle: true
		});

		$('#horasaida').mask('00/00/0000 00:00:00');
		$('#hora_saida').mask('00/00/0000 00:00:00');

		$("#saida").hide();
		//$("#collapseSaida").show();
		$('#list').click(function(){
		    $("#saida").show();
		    $("#barcode-saida").hide();
		});

		$('#btn-barcode').click(function(){
		    $("#saida").hide();
		    $("#barcode-saida").show();
		});

	</script>

</body>
</html>
