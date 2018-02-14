<?php
//Include the database configuration file
include 'conexao.php';

if(!empty($_POST["id"])){
    //Fetch all state data
    $query = $conn->query("SELECT * FROM entrada WHERE id = ".$_POST['id']." ");		
    
    //Count total number of rows
    $rowCount = $query->num_rows;
	
	$row = $query->fetch_assoc();
	
	$marcas = $conn->query("SELECT name FROM marcas WHERE id = ".$row['marca_id']." ");
	$marca = $marcas->fetch_assoc();
	$modelos = $conn->query("SELECT name FROM modelos WHERE id = ".$row['modelo_id']." ");
	$modelo = $modelos->fetch_assoc();
	$salas = $conn->query("SELECT sala FROM salas WHERE sala = ".$row['sala_id']." ");
	$sala = $salas->fetch_assoc();
	$date = new DateTime($row['data_hora_entrada']);
	date_default_timezone_set('America/Sao_Paulo');
	$datenow = new DateTime(date("Y-m-d H:i:s"));
	$tempo = $datenow->diff($date)->format('%h:%i:%s');	

    //State option list
    if($rowCount > 0){		
			echo	"<label class='label-input100' for='marca'>Marca do Veículo</label>				 ";
			echo	"<div class='wrap-input100 validate-input' >  ";
			echo	"<input class='input100' type='text' name='Marca' id='Marca' value='".$marca['name']."' readonly>  ";
			echo	"</div>                                                                          ";
            echo    "                                                                                ";
			echo	"<label class='label-input100' for='modelo'>Modelo do Veículo</label>            ";
			echo	"<div class='wrap-input100'>                                                     ";
			echo	"<input class='input100' type='text' name='Modelo' id='Modelo' value='".$modelo['name']."' readonly>";
			echo	"</div>                                                                          ";
            echo    "                                                                                ";
			echo	"<label class='label-input100' for='sala'>Sala Solicitada</label>                ";
			echo	"<div class='wrap-input100 validate-input'>                                      ";
			echo	"<input class='input100' type='text' name='Sala' id='Sala' value='".$sala['sala']."' readonly> ";
			echo	"</div>                                                                          ";			
			echo    "                                                                                ";
			echo	"<label class='label-input100' for='horaentrada'>Hora da entrada</label>                ";
			echo	"<div class='wrap-input100 validate-input'>                                      ";
			echo	"<input class='input100' type='text' name='horaentrada' id='horaentrada' value='".$date->format( 'd-m-Y H:i:s' )."' readonly> ";
			echo	"</div> ";				
}}
?>