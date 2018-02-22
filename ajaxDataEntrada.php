<?php
//Include the database configuration file
include 'conexao.php';
require 'vendor/autoload.php';

use Sinesp\Sinesp;

if(!empty($_POST["placaentrada"])){

$veiculo = new Sinesp;

try {
    $veiculo->buscar($_POST["placaentrada"]);
    if ($veiculo->existe()) {
        //print_r($veiculo->dados());
        //echo 'O ano do veiculo eh ' , $veiculo->anoModelo, PHP_EOL;
		$pieces = explode("/", $veiculo->marca);
			echo	"<label class='label-input100' for='marca'>Marca do Veículo</label>				 ";
			echo	"<div class='wrap-input100 validate-input' >  ";
			echo	"<input class='input100' type='text' name='Marca' id='Marca' value='".$pieces[0]."' readonly>  ";
			echo	"</div>                                                                          ";
            echo    "                                                                                ";
			echo	"<label class='label-input100' for='modelo'>Modelo do Veículo</label>            ";
			echo	"<div class='wrap-input100'>                                                     ";
			echo	"<input class='input100' type='text' name='Modelo' id='Modelo' value='".$pieces[1]."' readonly>";
			echo	"</div>                                                                          ";
    }
    else
    {
      echo	"<label class='label-input100' for='marca'>Marca do Veículo</label>				 ";
      echo	"<div class='wrap-input100 validate-input' >  ";
      echo	"<input class='input100' type='text' name='Marca' id='Marca' value='Nao Encontrado' readonly>  ";
      echo	"</div>                                                                          ";
      echo  "                                                                                ";
      echo	"<label class='label-input100' for='modelo'>Modelo do Veículo</label>            ";
      echo	"<div class='wrap-input100'>                                                     ";
      echo	"<input class='input100' type='text' name='Modelo' id='Modelo' value='Nao Encontrado' readonly>";
      echo	"</div>";
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
}
?>
