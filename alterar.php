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
	<title>Alterar Usuário</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/usericon.png"/>
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
			<form class="contact100-form validate-form" method="post" action="alterar_update.php">
				<span class="contact100-form-title">
					Alterar Usuário
				</span>
        <label class="label-input100" for="usuario">Escolha o Usuário que deseja alterar</label>
        <div class="wrap-input100 " data-validate="Selecione um usuário">
          <?php
						require 'conexao.php';
						$sql = "SELECT * FROM users WHERE id NOT IN (".$_SESSION['user_id'].")";
						$result = mysqli_query($conn,$sql);
						echo "<select required class='form-control input100' id ='info' name='info'>";
						echo "<option value='0'>Selecione o usuario </option>";
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
						}
						echo "</select>";

					?>
        </div>
        <div id="alterar" name="alterar" class="wrap-input100 ">
        </div>
				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						Alterar Usuário
					</button>
				</div>
			</form>

			<div class="contact100-more flex-col-c-m" style="background-image: url('images/bg-01.jpg');">
			</div>
		</div>
	</div>

<!--===============================================================================================-->
</body>
</html>
