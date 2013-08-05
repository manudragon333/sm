<?
//print_r($details);

$this->load->library('fpdf');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Image('css/images/college_logo.png',10,6,46,20);
$pdf->Cell(53);
$pdf->Cell(5,10,$details[0]->college_name);


$pdf->Ln();
$pdf->Cell(53);
$pdf->Cell(90,10,'Tanikella, Khammam',0,1,'C');
$pdf->Ln(8);
$pdf->Cell(75);
$pdf->Cell(50,10,'Fee Ledger Report');
    $pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Name:".$details[0]->name);


$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Father Name:".$details[0]->fathers_name);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"HT Number:".$details[0]->students_number);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Course:".$details[0]->course_name);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Branch:".$details[0]->branch_name);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Receipt No:".$details[0]->receipt_no);
$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Fee Paid for:".$details[0]->feeforyear);
$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Type of Fee:".$details[0]->typeoffee);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Amount:".$details[0]->amount);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Payment Type:".$details[0]->paymenttype);
$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Fee Collected by:".$details[0]->updatedby);
$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Date:".$details[0]->date);



$pdf->Output('report.pdf','i');
?>