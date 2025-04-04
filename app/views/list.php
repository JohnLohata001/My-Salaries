<?php

//  require ROOT. "/assets/fpdf/fpdf.php";
include("fpdf/fpdf.php");
// echo REAL_PATH. '/assets/';

$result  = selectAll('my_times');

//$result = $stmt->fetchAll(); // add for select sql
$Nombre = 0;



$pdf = new FPDF();

$pdf->SetMargins(20, 15, 20);

$pdf->AddPage();

$x = 30;
$y = 40;




// $pdf->Image('', 20, 15, 20);
// $pdf->GetPageHeight() - 2 * $y;
// $pdf->GetPageWidth() - 2 * $x;

$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(23, 93, 159);
// $pdf->setAlpha(0.5);

$total = 0;
$total_hours = 0;
$hours = 0;
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(23, 93, 159);
$pdf->SetFillColor(23, 93, 159);
$pdf->Cell(50, 10, '', '', 0, 'C');
$pdf->Cell(50, 10, 'WORK TIMES & SALARY', 'B', 1, 'C');

$pdf->Ln(15);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(23, 93, 159);
$pdf->Cell(50, 10, 'Date', 1, 0, 'C');
$pdf->Cell(50, 10, 'Times', 1, 0, 'C');
$pdf->Cell(50, 10, 'Money', 1, 1, 'C');

foreach ($result as $dataList):

    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(23, 93, 159);
    $pdf->Cell(50, 10, substr($dataList['date_type'], 0, 10), 1, 0, 'C');

    $timeStart = strtotime($dataList['time_started']);
    $timeEnd = strtotime($dataList['time_ended']);
    $hourWork = ($timeEnd - $timeStart);

    $pdf->Cell(50, 10, floor($hourWork / (60 * 60)), 1, 0, 'C');
    $pdf->Cell(50, 10, floor($hourWork / (60 * 60) * 5), 1, 1, 'C');
    $Nombre++;
    $tot = floor($hourWork / (60 * 60) * 5);
    $total = $total + $tot;
    $hours = $hourWork / (60 * 60);
    $total_hours += $hours;
    
endforeach;



$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(80, 10, 'Total Hours', 1, 0, 'C');
$pdf->Cell(70, 10, number_format($total_hours) . ' Hours', 1, 0, 'C');
// $pdf->Cell(57, 10, $Nombre, 1, 1, 'C');

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(80, 10, 'Total Genral', 1, 0, 'C');
$pdf->Cell(70, 10, chr(128) . ' ' . number_format($total, 2), 1, 0, 'C');
// $pdf->Cell(57, 10, $Nombre, 1, 1, 'C');


$pdf->Output();
