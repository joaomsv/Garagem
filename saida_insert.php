<?php
require 'conexao.php';
include 'saida.php';
// Check connection
if($conn === false){
    die("ERROR: Não foi possível estabelecer conexao " . mysqli_connect_error());
}
$update = " UPDATE entrada SET data_hora_saida= NOW() WHERE id = ".$_POST['placa']." ";
mysqli_query($conn, $update);

 $query = $conn->query("SELECT * FROM entrada WHERE id = ".$_POST['placa']." ");
// Attempt insert query execution
$row = $query->fetch_assoc();
$data_s = strtotime($row['data_hora_saida']);
$data_e = strtotime($row['data_hora_entrada']);

$tempo = $data_s - $data_e;

$dias = floor($tempo / 86400);
$horas   = floor(($tempo - ($dias * 86400)) / 3600) + $dias*24;
$minutos = floor(($tempo - ($dias * 86400) - ($horas * 3600))/60) + $horas*60;
$seconds = "00";

$tempo = $horas.$minutos.$seconds;
$sql = "UPDATE entrada SET tempo = '".$tempo."' WHERE id = ".$_POST['placa']." ";

$valor = 0;

if($horas < 1)
{
	if($minutos < 41)
			$valor = 3;

	else
		$valor = 6;
}
else
{
	if(($minutos > 41 && $minutos < 59)||($minutos >= 0 && $minutos < 10))
		$valor = $horas*6 + 6;
	else

		$valor = $horas*6 + 3;
}

$total ="UPDATE entrada SET valor = '".$valor."' WHERE id = ".$_POST['placa']." ";
mysqli_query($conn, $total);

//ATUALIZAR O STATUS PARA 1
$status ="UPDATE entrada SET status = 1 WHERE id = ".$_POST['placa']." ";
mysqli_query($conn, $status);


if(mysqli_query($conn, $sql)){
    echo "<script type='text/javascript'>
	alert('Saída registrada com sucesso');
	//document.location.href='saida.php';
</script>";	// MUDAR PARA document.location.href='/' QUANDO MIGRAR PRO SERVIDOR

} else{
    echo "<script type='text/javascript'>alert('ERROR: Não foi possível registrar $sql. ')</script>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
