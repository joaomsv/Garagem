<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<?php
require 'conexao.php';
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

//include 'entrada.php';
// Check connection
if ($conn === false) {
    die("ERROR: Não foi possível estabelecer conexao " . mysqli_connect_error());
}

date_default_timezone_set('America/Sao_Paulo');
$hora_saida = date("Y-m-d H:i:s");

if (!empty($_POST["placa"])) {
    $identificador = $_POST["placa"];

    $update = " UPDATE entrada SET data_hora_saida= '".$hora_saida."' WHERE id = ".$_POST['placa']." ";
    mysqli_query($conn, $update);

    $query = $conn->query("SELECT * FROM entrada WHERE id = ".$_POST['placa']." ");
    // Attempt insert query execution
    $row = $query->fetch_assoc();
    $data_s = strtotime($row['data_hora_saida']);
    $data_e = strtotime($row['data_hora_entrada']);

    $tempo = $data_s - $data_e;

    $horas = floor($tempo / 3600);
    $minutos = floor(($tempo / 60) % 60);
    $segundos = $tempo % 60;

    if ($horas < 10) {
        $horas = sprintf("%02d", $horas);//sprintf 02d = Dois digitos ---- 0 a esquerda
    }
    if ($minutos < 10) {
        $minutos = sprintf("%02d", $minutos);
    }
    if ($segundos < 10) {
        $segundos = sprintf("%02d", $segundos);
    }

    $tempo = $horas.$minutos.$segundos;
    $sql = "UPDATE entrada SET tempo = '".$tempo."' WHERE id = ".$_POST['placa']." ";

    $valor = 0;

    if ($horas < 1) {
        if ($minutos <= 10 && $segundos ==0) {
            $valor = 0;
        } elseif (($minutos == 10 && $segundos >0)||($minutos>10 && ($minutos<=30 && $segundos ==0)) || $minutos < 30) {
            $valor = 3;
        } else {
            $valor = 6;
        }
    } else {
        if (($minutos<=30 && $segundos ==0)||$minutos<30) {
            $valor = $horas*6 + 3;
        } else {
            $valor = $horas*6 + 6;
        }
    }

    $total ="UPDATE entrada SET valor = '".$valor."' WHERE id = ".$_POST['placa']." ";
    mysqli_query($conn, $total);

    //ATUALIZAR O STATUS PARA 1
    $status ="UPDATE entrada SET status = 1 WHERE id = ".$_POST['placa']." ";
    mysqli_query($conn, $status);
} // fim do if

//Inicio do codigo de barras !
elseif (!empty($_POST["barcode"])) {
    $identificador = $_POST["barcode"];

    $query2 = $conn->query("SELECT status FROM entrada WHERE id = ".$_POST['barcode']." ");
    // Attempt insert query execution
    $row2 = $query2->fetch_assoc();
    if ($row2['status']==0) {
        $update = " UPDATE entrada SET data_hora_saida= '".$hora_saida."' WHERE id = ".$_POST['barcode']." ";
        mysqli_query($conn, $update);

        $query = $conn->query("SELECT * FROM entrada WHERE id = ".$_POST['barcode']." ");
        // Attempt insert query execution
        $row = $query->fetch_assoc();
        $data_s = strtotime($row['data_hora_saida']);
        $data_e = strtotime($row['data_hora_entrada']);

        $tempo = $data_s - $data_e;

        $horas = floor($tempo / 3600);
        $minutos = floor(($tempo / 60) % 60);
        $segundos = $tempo % 60;

        if ($horas < 10) {
            $horas = sprintf("%02d", $horas);//sprintf 02d = Dois digitos ---- 0 a esquerda
        }
        if ($minutos < 10) {
            $minutos = sprintf("%02d", $minutos);
        }
        if ($segundos < 10) {
            $segundos = sprintf("%02d", $segundos);
        }

        $tempo = $horas.$minutos.$segundos;
        $sql = "UPDATE entrada SET tempo = '".$tempo."' WHERE id = ".$_POST['barcode']." ";

        $valor = 0;

        if ($horas < 1) {
            if ($minutos <= 10 && $segundos ==0) {
                $valor = 0;
            } elseif (($minutos == 10 && $segundos >0)||($minutos>10 && ($minutos<=30 && $segundos ==0)) || $minutos < 30) {
                $valor = 3;
            } else {
                $valor = 6;
            }
        } else {
            if (($minutos<=30 && $segundos ==0)||$minutos<30) {
                $valor = $horas*6 + 3;
            } else {
                $valor = $horas*6 + 6;
            }
        }

        $total ="UPDATE entrada SET valor = '".$valor."' WHERE id = ".$_POST['barcode']." ";
        mysqli_query($conn, $total);

        //ATUALIZAR O STATUS PARA 1
        $status ="UPDATE entrada SET status = 1 WHERE id = ".$_POST['barcode']." ";
        mysqli_query($conn, $status);
    } else {
        echo "
          <div id='hw' class='alert alert-danger'>
            <strong>Erro!</strong> Veículo com saída já registrada !!!
          </div>";

        echo "
        <script type='text/javascript'>
          $('document').ready( function () {
            alert('ERRO!');
            alert('Veículo já registrado!');
          });
          document.location.href='entrada.php';
          </script>
          ";
    }
}//fim elsif

class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 34;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}


if (mysqli_query($conn, $sql)) {
    $query5 = ("SELECT *,TIME(tempo) FROM entrada WHERE id = '".$identificador."' ");
    $result5  = mysqli_query($conn, $query5);

    if (mysqli_num_rows($result5)==0) {
        echo "
    <div id='hw' class='alert alert-danger'>
    <strong>Erro!</strong> Veículo INEXISTENTE !!!
  </div>";

        echo "
  <script type='text/javascript'>
  $('document').ready( function () {
          alert('ERRO!');
          alert('Veículo inexistente!');
      });
  document.location.href='entrada.php';
  </script>
  ";
    }

    $row5 = mysqli_fetch_array($result5);


    $marcas = $conn->query("SELECT name FROM marcas WHERE id = ".$row5['marca_id']." ");
    $marca = $marcas->fetch_assoc();
    $modelos = $conn->query("SELECT name FROM modelos WHERE id = ".$row5['modelo_id']." ");
    $modelo = $modelos->fetch_assoc();
    $valor = $row5['valor'];
    $valor = 'R$'.$valor.',00';

    $data_hora_entrada = $row5['data_hora_entrada'];
    $data_hora_entrada = explode(' ', $data_hora_entrada);
    $dataE = new DateTime($data_hora_entrada[0]);

    $data_hora_saida = $row5['data_hora_saida'];
    $data_hora_saida = explode(' ', $data_hora_saida);
    $dataS = new DateTime($data_hora_saida[0]);

    /* Fill in your own connector here */
    $connector = new WindowsPrintConnector("EPSON TM-T20 Receipt");
    /* Information for the receipt */
    $items = array(
      new item("Placa", $row5['placa']),
      new item("Marca", $marca['name']),
      new item("Modelo", $modelo['name']),
      new item("Data Entrada", $dataE->format('d/m/Y')),
      new item("Hora Entrada", $data_hora_entrada[1]),
      new item("Data Saída", $dataS->format('d/m/Y')),
      new item("Hora Saída", $data_hora_saida[1]),
      new item("Tempo", $row5['TIME(tempo)']),
      new item("Valor", $valor),
  );


    /* Start the printer */

    $printer = new Printer($connector);


    $printer -> setJustification(Printer::JUSTIFY_CENTER);


    /* Name of shop */
    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer -> text("Golden Arch.\n");
    $printer -> selectPrintMode();
    $printer -> text("Saída.\n");
    $printer -> feed();
    $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer -> text("SALA:");
    $printer -> feed();
    $printer -> text((string)$row5['sala_id']);
    $printer -> feed(2);
    $printer -> selectPrintMode();
    $printer -> text("Dados do Veículo\n");
    $printer -> setEmphasis(false);

    /* Items */
    $printer -> setJustification(Printer::JUSTIFY_LEFT);
    foreach ($items as $item) {
        $printer -> text($item);
    }

    $printer -> cut();
    $printer -> pulse();

    $printer -> close();

    echo "<script type='text/javascript'>
	alert('Saída registrada com sucesso');
	document.location.href='entrada.php';
</script>";	// MUDAR PARA document.location.href='/' QUANDO MIGRAR PRO SERVIDOR
} else {
    echo "<script type='text/javascript'>alert('ERROR: Não foi possível registrar $sql. ')</script>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
