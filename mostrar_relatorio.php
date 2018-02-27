<?php
require 'conexao.php';

if(!empty($_POST['salarelatorio']) && $_POST['salarelatorio']!=1)
{
$salarecebida[] = $_POST['salarelatorio'];
}
else {
  $salas = $conn->query("SELECT DISTINCT sala FROM salas WHERE 1 ");
  $rowCount2 = $salas->num_rows;
  if($rowCount2 > 0){
      while($salarecebida2 = $salas->fetch_assoc())
  {
  $salarecebida[] = $salarecebida2['sala'];
}
}
}
if(!empty($_POST['mes']))
{
$mesrecebido[] = $_POST['mes'];
}
else {
  $mes = $conn->query("SELECT DISTINCT MONTH(data_hora_saida) FROM entrada WHERE 1 ");
  $rowCount3 = $mes->num_rows;

  if($rowCount3 > 0){
      while($mesrecebido2 = $mes->fetch_assoc())
  {
  $mesrecebido[] = $mesrecebido2['MONTH(data_hora_saida)'];
}
}
}
if(!empty($_POST['dia']))
{
$diarecebido[] = $_POST['dia'];
}
else {
  $dia = $conn->query("SELECT DISTINCT DAY(data_hora_saida) FROM entrada WHERE 1 ");
  $rowCount4 = $dia->num_rows;

  if($rowCount4 > 0){
      while($diarecebido2 = $dia->fetch_assoc())
  {
  $diarecebido[] = $diarecebido2['DAY(data_hora_saida)'];
}
}
}


$query = $conn->query("SELECT *,TIME(tempo) FROM entrada WHERE YEAR(data_hora_saida) = '".$_POST['ano']."' and MONTH(data_hora_saida) IN ('" . implode("','", $mesrecebido) . "') and DAY(data_hora_saida) IN ('" . implode("','", $diarecebido) . "') and sala_id IN ('" . implode("','", $salarecebida) . "') AND status = 1 ORDER BY sala_id ASC");
$rowCount = $query->num_rows;

require_once("fpdf/fpdf.php");

$pdf= new FPDF("P","pt","A4");
$pdf->AddPage();

$pdf->SetFont('arial','B',18);
$pdf->Cell(0,5,"Relatorio",0,1,'C');
$pdf->Ln(30);

if($rowCount > 0){
    while($row = $query->fetch_assoc())
{
$query2 = ("SELECT name FROM modelos WHERE id = '".$row['modelo_id']."' ");

$result2  = mysqli_query($conn,$query2);
$row2 = mysqli_fetch_array($result2);

$query3 = ("SELECT name FROM marcas WHERE id = '".$row['marca_id']."' ");

$result3  = mysqli_query($conn,$query3);

$row3 = mysqli_fetch_array($result3);

$data_hora_entrada = $row['data_hora_entrada'];
$data_hora_entrada = explode(' ',$data_hora_entrada);
$dataE = new DateTime($data_hora_entrada[0]);
$placa  =$row['placa'];
$modelo =$row2['name'];
$marca  =$row3['name'];
$sala   =$row['sala_id'];
$data_hora_saida = $row['data_hora_saida'];
$data_hora_saida = explode(' ',$data_hora_saida);
$dataS = new DateTime($data_hora_saida[0]);
$valor = $row['valor'];
$valor = 'R$'.$valor.',00';
$tempo = $row['TIME(tempo)'];

$pdf->SetFont('arial','B',16);
$pdf->Cell(60,20,"Dados do Veiculo",0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(80,0,"-----------------------------------",0,1,'L');

//Placa
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Placa:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$placa,0,1,'L');

//Marca
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Marca:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$marca,0,1,'L');

//Modelo
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Modelo:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$modelo,0,1,'L');

//Sala
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Sala:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$sala,0,1,'L');

//Data e Hora entrada
$pdf->SetFont('arial','B',20);
$pdf->Cell(60,20,"Entrada",0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(80,0,"-----------------------------------",0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Data:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,$dataE->format('d/m/Y'),0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Hora:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,$data_hora_entrada[1],0,1,'L');

//Data e Hora saida
$pdf->SetFont('arial','B',20);
$pdf->Cell(60,20,"Saida",0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(80,0,"-----------------------------------",0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Data:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,$dataS->format('d/m/Y'),0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Hora:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,$data_hora_saida[1],0,1,'L');

//Tempo Total
$pdf->SetFont('arial','B',12);
$pdf->Cell(80,10,"====================",0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Tempo:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$tempo,0,1,'L');

//Valor
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Valor:",0,0,'L');
$pdf->setFont('arial','',12);
//$pdf->Cell(18,20,"R$",0,0,'L');
$pdf->Cell(0,20,$valor,0,0,'L');
$pdf->Ln(20);
$pdf->Cell(0,5,"","B",1,'C');

$pdf->Ln(10);
	}
}
$pdf->Output("entrada.pdf","I");
?>
