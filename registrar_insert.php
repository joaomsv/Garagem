<?php
require 'conexao.php';
include 'registrar.php';
// Check connection
if($conn === false){
    die("ERROR: Não foi possível estabelecer conexao " . mysqli_connect_error());
}
// Attempt insert query execution
$sql = "INSERT INTO users (name, matricula, username, password, cpf, role_id) VALUES ('".$_POST["name"]."',
							 '".$_POST["matricula"]."', '".$_POST["username"]."', '".$_POST["password"]."', '".$_POST["cpf"]."', '".$_POST["role"]."')";

if(mysqli_query($conn, $sql)){

    echo "<script type='text/javascript'>
	alert('Usuário registrado com sucesso');
	document.location.href='registrar.php'
</script>";	// MUDAR PARA document.location.href='/' QUANDO MIGRAR PRO SERVIDOR //$('#form').submit();

} else{
    echo "<script type='text/javascript'>alert('ERROR: Não foi possível registrar $sql. ')</script>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

?>
