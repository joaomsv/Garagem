<?php
session_start();
require 'conexao.php';
// Check connection
if($conn === false){
    die("ERROR: Não foi possível estabelecer conexao " . mysqli_connect_error());
}

date_default_timezone_set('America/Sao_Paulo');
$hora_modificacao = date("Y-m-d H:i:s");
$usuario_data = "{$_SESSION['user_name']} {$hora_modificacao}";

// Attempt insert query execution
if(!empty($_POST["placa_saida"])){

$aux = DateTime::createFromFormat("d/m/Y H:i:s", $_POST['hora_saida']);
$data = $aux->format("Y-m-d H-i-s");

$placa = $_POST['placa_saida'];

$sql = "UPDATE entrada
        SET data_hora_saida = '".$data."', status = 1, modificado = 1, usuario = '".$usuario_data."'
        WHERE id = '".$placa."' ";

        $query = $conn->query("SELECT * FROM entrada WHERE id = '".$placa."' ");
        // Attempt insert query execution
        $row = $query->fetch_assoc();
        $data_s = strtotime($row['data_hora_saida']);
        $data_e = strtotime($row['data_hora_entrada']);

        $tempo = $data_s - $data_e;

        $horas = floor($tempo / 3600);
        $minutos = floor(($tempo / 60) % 60);
        $segundos = $tempo % 60;

        if($horas < 10)
        {
          $horas = sprintf("%02d", $horas);//sprintf 02d = Dois digitos ---- 0 a esquerda
        }
        if ($minutos < 10) {
          $minutos = sprintf("%02d", $minutos);
        }
        if ($segundos < 10) {
          $segundos = sprintf("%02d", $segundos);
        }

        $tempo = $horas.$minutos.$segundos;
        $sql2 = "UPDATE entrada SET tempo = '".$tempo."' WHERE id = '".$placa."' ";
        mysqli_query($conn, $sql2);

        $valor = 0;

        if($horas < 1)
        {
        	if($minutos <= 10 && $segundos ==0)
        			$valor = 0;

        	elseif(($minutos == 10 && $segundos >0)||($minutos>10 && ($minutos<=30 && $segundos ==0)) || $minutos < 30){
        		$valor = 3;
        }

        else {
          $valor = 6;
        }

        }
        else
        {
        	if(($minutos<=30 && $segundos ==0)||$minutos<30)
        		$valor = $horas*6 + 3;
        	else
        		$valor = $horas*6 + 6;
        }

        $total ="UPDATE entrada SET valor = '".$valor."' WHERE id = '".$placa."' ";
        mysqli_query($conn, $total);



      } // fim do if

      //Inicio do codigo de barras !
      elseif(!empty($_POST["barcode"])){


        $aux = DateTime::createFromFormat("d/m/Y H:i:s", $_POST['horasaida']);
        $data = $aux->format("Y-m-d H-i-s");
        $sql = "UPDATE entrada
                SET data_hora_saida = '".$data."', status = 1, modificado = 1, usuario = '".$usuario_data."'
                WHERE id = '".$_POST['barcode']."'";

                $query = $conn->query("SELECT * FROM entrada WHERE id = ".$_POST['barcode']." ");
                // Attempt insert query execution
                $row = $query->fetch_assoc();
                $data_s = strtotime($row['data_hora_saida']);
                $data_e = strtotime($row['data_hora_entrada']);

                $tempo = $data_s - $data_e;

                $horas = floor($tempo / 3600);
                $minutos = floor(($tempo / 60) % 60);
                $segundos = $tempo % 60;

                if($horas < 10)
                {
                  $horas = sprintf("%02d", $horas);//sprintf 02d = Dois digitos ---- 0 a esquerda
                }
                if ($minutos < 10) {
                  $minutos = sprintf("%02d", $minutos);
                }
                if ($segundos < 10) {
                  $segundos = sprintf("%02d", $segundos);
                }

                $tempo = $horas.$minutos.$segundos;
                $sql2 = "UPDATE entrada SET tempo = '".$tempo."' WHERE id = ".$_POST['barcode']." ";
                mysqli_query($conn, $sql2);

                $valor = 0;

                if($horas < 1)
                {
                	if($minutos <= 10 && $segundos ==0)
                			$valor = 0;

                	elseif(($minutos == 10 && $segundos >0)||($minutos>10 && ($minutos<=30 && $segundos ==0)) || $minutos < 30){
                		$valor = 3;
                }

                else {
                  $valor = 6;
                }

                }
                else
                {
                	if(($minutos<=30 && $segundos ==0)||$minutos<30)
                		$valor = $horas*6 + 3;
                	else
                		$valor = $horas*6 + 6;
                }

                $total ="UPDATE entrada SET valor = '".$valor."' WHERE id = ".$_POST['barcode']." ";
                mysqli_query($conn, $total);

      }

if(mysqli_query($conn, $sql)){
    echo "<script type='text/javascript'>
	alert('Saída alterada com sucesso');
	//document.location.href='alterar_saida.php'
</script>";	// MUDAR PARA document.location.href='/' QUANDO MIGRAR PRO SERVIDOR //$('#form').submit();

} else{
    echo "<script type='text/javascript'>alert('ERROR: Não foi possível registrar $sql. ')</script>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

?>
