
<?php
require 'conexao.php';
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
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
$data = date("d/m/Y");
$hora = date("H:i:s");

$sql = "INSERT INTO entrada (placa, marca_id, modelo_id, sala_id, data_hora_entrada) VALUES ('".$_POST["placaentrada"]."',
							 '".$row3['id']."', '".$row4['id']."', '".$_POST["Sala"]."', '".$hora_entrada."')";

echo "<form style='display: hidden' action='print.php' method='POST' id='form'>";
echo "  <input type='hidden' id='var1' name='var1' value='".$hora_entrada."'/>                 ";
echo "  <input type='hidden' id='var2' name='var2' value=''/>                 ";
echo "</form>";

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
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}

if(mysqli_query($conn, $sql)){

$query5 = ("SELECT id FROM entrada WHERE data_hora_entrada = '".$hora_entrada."' ");
$result5  = mysqli_query($conn,$query5);
$row5 = mysqli_fetch_array($result5);


/* Fill in your own connector here */
$connector = new WindowsPrintConnector("EPSON TM-T20 Receipt");
/* Information for the receipt */
$items = array(
    new item("Placa", $_POST['placaentrada']),
    new item("Marca", $_POST['MarcaEntrada']),
    new item("Modelo", $_POST['ModeloEntrada']),
    new item("Data", $data),
    new item("Hora", $hora),
);


/* Start the printer */
$logo = EscposImage::load("images/assinatura.png", false);
$printer = new Printer($connector);


$printer -> setJustification(Printer::JUSTIFY_CENTER);


/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("Golden Arch.\n");
$printer -> selectPrintMode();
$printer -> text("Entrada.\n");
$printer -> feed();
$printer -> selectPrintMode();
$printer -> text("Dados do Veículo\n");
$printer -> setEmphasis(false);

/* Items */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
foreach ($items as $item) {
    $printer -> text($item);
}
/*Sala*/

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setEmphasis(true);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("SALA:\n".$_POST['Sala']);

/*Assinatura*/
$printer -> setEmphasis(false);
$printer -> selectPrintMode();
$printer -> feed(2);
$printer -> graphics($logo);
$printer -> selectPrintMode();

/* Codigo de Barra */
$printer -> feed(2);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->barcode($row5['id'], Printer::BARCODE_CODE39);//Codigo de Barra é o identificador único do veículo


/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();

/* A wrapper to do organise item names & prices into columns */

echo "<script type='text/javascript'>
alert('Entrada registrada com sucesso');
document.location.href='entrada.php'
</script>";
} else{
    echo "<script type='text/javascript'>alert('ERROR: Não foi possível registrar $sql. ')</script>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

?>
