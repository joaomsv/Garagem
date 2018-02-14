<?php 
require 'conexao.php';

$query = $conn->query("SELECT *,TIME(tempo) FROM entrada WHERE YEAR(data_hora_saida) = '".$_POST['ano']."' and MONTH(data_hora_saida) = '".$_POST['mes']."' ORDER BY sala_id ASC");
$rowCount = $query->num_rows;

require_once("fpdf/fpdf.php");
 
$pdf= new FPDF("P","pt","A4");
$pdf->AddPage();

$pdf->SetFont('arial','B',18);
$pdf->Cell(0,5,"Relatorio Mensal",0,1,'C');
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
$placa  =$row['placa'];
$modelo =$row2['name'];
$marca  =$row3['name'];
$sala   =$row['sala_id'];
$data_hora_saida = $row['data_hora_saida'];
$valor = $row['valor'];
$tempo = $row['TIME(tempo)'];

//Data e Hora
$pdf->SetFont('arial','B',12);
$pdf->Cell(140,20,"Data e hora de Entrada:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,$data_hora_entrada,0,1,'L');
 
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

//Data e Hora saida
$pdf->SetFont('arial','B',12);
$pdf->Cell(140,20,"Data e hora de Saida:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,$data_hora_saida,0,1,'L');

//Tempo
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Tempo:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$tempo,0,1,'L');

//Valor
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Valor:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,"R$",0,0,'L');
$pdf->Cell(400,20,$valor,0,0,'L');
$pdf->Ln(20);
$pdf->Cell(0,5,"","B",1,'C');

$pdf->Ln(10);
	}
}
$pdf->Output("entrada.pdf","I");
?>