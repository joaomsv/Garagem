<?php 
require 'conexao.php';

$query = ("SELECT * FROM entrada WHERE data_hora_entrada = '".$_POST['var1']."' ");

$result  = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

$query2 = ("SELECT name FROM modelos WHERE id = '".$row['modelo_id']."' ");

$result2  = mysqli_query($conn,$query2);
$row2 = mysqli_fetch_array($result2);

$query3 = ("SELECT name FROM marcas WHERE id = '".$row['marca_id']."' ");

$result3  = mysqli_query($conn,$query3);
$row3 = mysqli_fetch_array($result3);

$data_hora = $_POST['var1'];
$placa  =$row['placa'];
$modelo =$row2['name'];
$marca  =$row3['name'];
$sala   =$row['sala_id'];
$assinatura = "---------------------------------------------------------------------------------";
 
require_once("fpdf/fpdf.php");
 
$pdf= new FPDF("P","pt","A4");
 
 
$pdf->AddPage();
 
$pdf->SetFont('arial','B',18);
$pdf->Cell(0,5,"Recibo de Entrada",0,1,'C');
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Ln(8);
 
 
//Data e Hora
$pdf->SetFont('arial','B',12);
$pdf->Cell(140,20,"Data e hora de Entrada:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,$data_hora,0,1,'L');
 
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
 
$pdf->ln(10);
//Assinatura
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Assinatura:",0,1,'L');
$pdf->setFont('arial','',12);
$pdf->MultiCell(0,20,$assinatura,0,'J');
 
$pdf->Output("entrada.pdf","I");
?>