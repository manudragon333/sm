
<?
$this->load->library('fpdf');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Image('css/images/college_logo.png',10,6,46,20);
$pdf->Cell(53);
$pdf->Cell(5,10,$student_details[0]->college_name);

$pdf->Ln();
$pdf->Cell(53);
$pdf->Cell(90,10,'Tanikella, Khammam',0,1,'C');
$pdf->Ln(8);
$pdf->Cell(75);
$pdf->Cell(50,10,'Fee Ledger Report');
    $pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Name:".$student_details[0]->name);



$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Father Name:".$student_details[0]->fathers_name);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"HT Number:".$student_details[0]->students_number);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Course:".$student_details[0]->course_name);

$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Branch:".$student_details[0]->branch_name);


$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Records found:".count($payment_details));

if(count($payment_details)>=1)
{
$pdf->Ln(10);
$pdf->Cell(15);
$pdf->Cell(50,10,"Payment for:".$payment_details[0]->feeforyear);

$header = array('Date', 'Receipt No', 'Type of Fee', 'Amount Paid','Payment Type','Balance as of day','Updated by');

$pdf->Ln(10);
foreach($header as $col)
        $pdf->Cell(28,6,$col,1);
    $pdf->Ln();
    // Data
    foreach($payment_details as $row)
    {
	$data=array($row->date,$row->receipt_no,$row->typeoffee,$row->amount,$row->paymenttype, $row->remarks,$row->updatedby);
        foreach($data as $col)
            $pdf->Cell(28,6,$col,1);
        $pdf->Ln();
    }


}

$pdf->Output('report.pdf','D');

echo "success";
?>