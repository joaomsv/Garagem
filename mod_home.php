<?php
	session_start();
	if (isset($_SESSION['url'])) {
		if (isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=="2") {
			$_SESSION['url'] = $_SERVER['REQUEST_URI'];
		} else {
			header("location: " .$_SESSION['url']);
		}
	}else {
		header("location: index.php");
	}
 ?>
<!DOCTYPE html>
<html>
<body>
	<h1><?php echo "Bem-Vindo " .$_SESSION['user_name']; ?></h1>
	<button onclick="window.location.href='logout.php'" type="logout" name="logout">Logout</button>
</body>
</html>
