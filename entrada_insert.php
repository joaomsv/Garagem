<?php
require 'conexao.php';
include 'entrada.php';
// Check connection
if($conn === false){
    die("ERROR: Não foi possível estabelecer conexao " . mysqli_connect_error());
}
 date_default_timezone_set('America/Sao_Paulo');
 $hora_entrada = date("Y-m-d H:i:s");
// Attempt insert query execution
$sql = "INSERT INTO entrada (placa, marca_id, modelo_id, sala_id, data_hora_entrada) VALUES ('".$_POST["placa"]."',
							 '".$_POST["Marca"]."', '".$_POST["Modelo"]."', '".$_POST["Sala"]."', '".$hora_entrada."')";
							 
echo "<form style='display: hidden' action='print.php' method='POST' id='form'>";
echo "  <input type='hidden' id='var1' name='var1' value='".$hora_entrada."'/>                 ";
echo "  <input type='hidden' id='var2' name='var2' value=''/>                 ";
echo "</form>							 									  ";
							 
if(mysqli_query($conn, $sql)){
	
    echo "<script type='text/javascript'>
	alert('Entrada registrada com sucesso');
	document.location.href='entrada.php'
</script>";	// MUDAR PARA document.location.href='/' QUANDO MIGRAR PRO SERVIDOR //$('#form').submit();

} else{
    echo "<script type='text/javascript'>alert('ERROR: Não foi possível registrar $sql. ')</script>" . mysqli_error($conn);
}
 
// Close connection
mysqli_close($conn);

?>