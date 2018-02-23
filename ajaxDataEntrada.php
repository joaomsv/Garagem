<<<<<<< HEAD
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
			echo	"<label class='label-input100' for='MarcaEntrada'>Marca do Veículo</label>				 ";
			echo	"<div class='wrap-input100 validate-input' >  ";
			echo	"<input class='input100' type='text' name='MarcaEntrada' id='MarcaEntrada' value='".$pieces[0]."' readonly>  ";
			echo	"</div>                                                                          ";
            echo    "                                                                                ";
			echo	"<label class='label-input100' for='ModeloEntrada'>Modelo do Veículo</label>            ";
			echo	"<div class='wrap-input100'>                                                     ";
			echo	"<input class='input100' type='text' name='ModeloEntrada' id='ModeloEntrada' value='".$pieces[1]."' readonly>";
			echo	"</div>                                                                          ";
    }
    else
    {
      echo	"<label class='label-input100' for='MarcaEntrada'>Marca do Veículo</label>				 ";
      echo	"<div class='wrap-input100 validate-input' >  ";
      echo	"<input class='input100' type='text' name='MarcaEntrada' id='MarcaEntrada' value='Nao Encontrado' readonly>  ";
      echo	"</div>                                                                          ";
      echo  "                                                                                ";
      echo	"<label class='label-input100' for='ModeloEntrada'>Modelo do Veículo</label>            ";
      echo	"<div class='wrap-input100'>                                                     ";
      echo	"<input class='input100' type='text' name='ModeloEntrada' id='ModeloEntrada' value='Nao Encontrado' readonly>";
      echo	"</div>";
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
}
?>
=======
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
			echo	"<label class='label-input100' for='MarcaEntrada'>Marca do Veículo</label>				 ";
			echo	"<div class='wrap-input100 validate-input' >  ";
			echo	"<input class='input100' type='text' name='MarcaEntrada' id='MarcaEntrada' value='".$pieces[0]."' readonly>  ";
			echo	"</div>                                                                          ";
            echo    "                                                                                ";
			echo	"<label class='label-input100' for='ModeloEntrada'>Modelo do Veículo</label>            ";
			echo	"<div class='wrap-input100'>                                                     ";
			echo	"<input class='input100' type='text' name='ModeloEntrada' id='ModeloEntrada' value='".$pieces[1]."' readonly>";
			echo	"</div>                                                                          ";
    }
    else
    {
      echo	"<label class='label-input100' for='MarcaEntrada'>Marca do Veículo</label>				 ";
      echo	"<div class='wrap-input100 validate-input' >  ";
      echo	"<input class='input100' type='text' name='MarcaEntrada' id='MarcaEntrada' value='Nao Encontrado' readonly>  ";
      echo	"</div>                                                                          ";
      echo  "                                                                                ";
      echo	"<label class='label-input100' for='ModeloEntrada'>Modelo do Veículo</label>            ";
      echo	"<div class='wrap-input100'>                                                     ";
      echo	"<input class='input100' type='text' name='ModeloEntrada' id='ModeloEntrada' value='Nao Encontrado' readonly>";
      echo	"</div>";
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
}
?>
>>>>>>> 7482806e8eea7dc2c9deba1af6287f0fd89f73d5
