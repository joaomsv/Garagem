<?php
	session_start();
	require 'db.php';
	$sql = "SELECT * FROM users WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'";
  $result = mysqli_query($conn,$sql) or die ('Error querying the database.');
  if (mysqli_num_rows($result) > 0)
  {
    $user = mysqli_fetch_assoc($result);
		$_SESSION['user_id'] = $user["id"];
		$_SESSION['user_name'] = $user["name"];
		$_SESSION['user_matricula'] = $user["matricula"];
		$_SESSION['user_username'] = $user["username"];
		$_SESSION['user_password'] = $user["password"];
		$_SESSION['user_cpf'] = $user["cpf"];
		$_SESSION['user_role_id'] = $user["role_id"];
    switch ($user["role_id"]) {
      case '1':
        echo "<script>document.location.href='admin_home.php';</script>";
        break;
      case '2':
        echo "<script>document.location.href='mod_home.php';</script>";
        break;
      case '3':
        echo "<script>document.location.href='user_home.php';</script>";
        break;
    }
  }
  else
  {
    echo
      "<script type='text/javascript'>
        alert('Usuario e/ou Senha incorreto.');
        document.location.href='index.php';
      </script>";
  }
?>
