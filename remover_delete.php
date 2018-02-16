<?php
require 'conexao.php';
include 'remover.php';
// Check connection
if($conn === false){
    die("ERROR: Não foi possível estabelecer conexao " . mysqli_connect_error());
}
// Attempt insert query execution
$sql = "DELETE FROM users WHERE id = ".$_POST['id']."";

if(mysqli_query($conn, $sql)){

    echo "<script type='text/javascript'>
	alert('Usuário removido com sucesso');
	document.location.href='remover.php'
</script>";	// MUDAR PARA document.location.href='/' QUANDO MIGRAR PRO SERVIDOR //$('#form').submit();

} else{
    echo "<script type='text/javascript'>alert('ERROR: Não foi possível remover $sql. ')</script>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

?>
