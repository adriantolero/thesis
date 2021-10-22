<?php
	
require('../../../../lib/fpdf/fpdf.php');

/**
* 
*/
class PDF extends FPDF
{
	function Header(){

		// Arial bold 15
	    $this->SetFont('Arial','B',15);
	    // Move to the right
	    $this->Cell(80);
	    // Title
	    $this->Cell(50,10,'Center for Continuing Education',2,0,'C');
	    // Line break
	    $this->Ln(20);

	}

	function Footer(){

		// Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

	}

	function BasicTable($header, $data)
	{
	    // Header
	    foreach($header as $col)
	        $this->Cell(40,7,$col,1);
	    $this->Ln();
	    // Data
	    foreach($data as $row)
	    {
	        foreach($row as $col)
	            $this->Cell(40,6,$col,1);
	        $this->Ln();
	    }
	}
}

$pdf = new PDF('P','mm','Letter');
$pdf->AliasNbPages();
$pdf->SetFont('Times','',12);
$pdf->BasicTable($header,$data);
$pdf->AddPage();


$pdf->Output();
	
?>	