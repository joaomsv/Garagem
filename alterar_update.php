<?php
require 'conexao.php';
// Check connection
if($conn === false){
    die("ERROR: Não foi possível estabelecer conexao " . mysqli_connect_error());
}
// Attempt insert query execution
$sql = "UPDATE users
        SET name = '".$_POST["name"]."', matricula = '".$_POST["matricula"]."', username = '".$_POST["username"]."', password = '".$_POST["password"]."', cpf = '".$_POST["cpf"]."', role_id = '".$_POST["role"]."'
        WHERE id = '".$_POST["info"]."'";

if(mysqli_query($conn, $sql)){

    echo "<script type='text/javascript'>
	alert('Usuário alterado com sucesso');
	document.location.href='alterar.php'
</script>";	// MUDAR PARA document.location.href='/' QUANDO MIGRAR PRO SERVIDOR //$('#form').submit();

} else{
    echo "<script type='text/javascript'>alert('ERROR: Não foi possível registrar $sql. ')</script>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

?>
