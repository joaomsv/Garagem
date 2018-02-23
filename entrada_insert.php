<?php
require 'conexao.php';
//include 'entrada.php';
// Check connection
if($conn === false){
    die("ERROR: Não foi possível estabelecer conexao " . mysqli_connect_error());
}

$query = $conn->query("INSERT INTO marcas (name) SELECT '".$_POST["MarcaEntrada"]."' FROM dual WHERE NOT EXISTS ( SELECT * FROM marcas WHERE (name) = ('".$_POST["MarcaEntrada"]."') )");
//Inserir ser não existir

$query3 = ("SELECT id FROM marcas WHERE name = '".$_POST["MarcaEntrada"]."' ");
$result3  = mysqli_query($conn,$query3);
$row3 = mysqli_fetch_array($result3);


$query2 = $conn->query("INSERT INTO modelos (name,marca_id) SELECT '".$_POST["ModeloEntrada"]."','".$row3['id']."' FROM dual WHERE NOT EXISTS ( SELECT * FROM modelos WHERE (name) = ('".$_POST["ModeloEntrada"]."') )");
//Inserir ser não existir

$query4 = ("SELECT id FROM modelos WHERE name = '".$_POST["ModeloEntrada"]."' ");
$result4  = mysqli_query($conn,$query4);
$row4 = mysqli_fetch_array($result4);

date_default_timezone_set('America/Sao_Paulo');
$hora_entrada = date("Y-m-d H:i:s");

$sql = "INSERT INTO entrada (placa, marca_id, modelo_id, sala_id, data_hora_entrada) VALUES ('".$_POST["placaentrada"]."',
							 '".$row3['id']."', '".$row4['id']."', '".$_POST["Sala"]."', '".$hora_entrada."')";

echo "<form style='display: hidden' action='print.php' method='POST' id='form'>";
echo "  <input type='hidden' id='var1' name='var1' value='".$hora_entrada."'/>                 ";
echo "  <input type='hidden' id='var2' name='var2' value=''/>                 ";
echo "</form>";

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
