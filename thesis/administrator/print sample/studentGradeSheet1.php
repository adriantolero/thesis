<?php
require('../fpdf181/fpdf.php');
include_once '../Model/Config.php';
include_once '../Model/StaffModel.php';
	

class PDF extends FPDF{
	function Header_PDF()
	{
		$this->drawWaterMark(50, $this->GetY()+5, 110, ($this->GetPageHeight()/2)-40);
		global $title;
	    $this->SetFont('Arial','B',13);
	    $this->Cell(0,5,'VISAYAS STATE UNIVERSITY',0,1,'C');
	    $this->SetFont('Arial','b',8);
	    $this->Cell(0,5,'VISCA, Baybay City, Leyte 6521-A',0,1,'C');
	    $this->SetFont('helvetica','B',10);
	    $this->Cell(0,8,'S T U D E N T  G R A D E S',0,1,'C');
	    $this->SetFont('Arial','b',10);
	    $this->Cell(0,5,$title,0,1,'C');
	    // Line break
	    $this->Ln(2);
	}
	function Footer()	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

	function drawWaterMark($x, $y, $w, $h){
		$this->Image("../Assets/images/watermark.png",$x,$y,$w, $h);
	}

	function studentInfo($info){
		$this->SetFont('Times','B',10);
		$this->Cell(55,5,'Student ID: '.$info['StudID'],0,0);
		$this->Cell(60,5,'Name: '.$info['LastName'].", ".$info['FirstName']." ".$info['MiddleName'],0,1);
		$this->Cell(55,5,'Course: '.$info['crsCode'],0,0);
		$this->Cell(60,5,'Major: '.$info['majorName'],0,0);
		$this->Cell(0,5,'Level: '.$info['yrLevel'],0,1);
		$this->Ln(2);
	}

	function tableHeader(){
		$hy = 7;
		$this->Cell(25,$hy,'Crs No',1,0);
		$this->Cell(75,$hy,'Description',1,0);
		$this->Cell(20,$hy,'Midterm',1,0, 'C');
		$this->Cell(20,$hy,'Final',1,0, 'C');
		$this->Cell(15,$hy,'Credit',1,0,'C');
		$this->Cell(0,$hy,'Instructor',1,1);
	}
	function tableBody($subjList){
		$hy = 6;
		$nonAcad = 0;
		$acad = 0;
		$midTermPoints = 0;
		$finalPoints = 0;
		$midTermAcad = 0;
		$finalAcad = 0;
		$this->SetFont('Times','',9);
		foreach ($subjList as $subj) {
			$units = $subj['units'];
			if($subj['units'] <= 0){
				$units = -$subj['units'];
				$nonAcad += $units;
			}else{
				$midTermPoints += ($subj['Midterm'] * $units);
				$finalPoints += ($subj['Final'] * $units);
				$acad += $subj['units'];

				$midTermAcad += is_numeric($subj['Midterm'])? $subj['units']: 0;
				$finalAcad += is_numeric($subj['Final'])? $subj['units']: 0;
			}
			$this->Cell(25,$hy,$subj['subCode'],1,0);
			$this->Cell(75,$hy,$subj['subDesc'].is_numeric($subj['Final']),1,0);
			$this->Cell(20,$hy,$subj['Midterm'],1,0,'C');
			$this->Cell(20,$hy,$subj['Final'],1,0,'C');	
			$this->Cell(15,$hy,$units,1,0,'C');
			$this->Cell(0,$hy,$subj['username'],1,1);
		}	
		$this->Ln(2);
		$this->Cell(100,5,'Total Grade Points: ',0,0,"R");	
		$this->Cell(20,5,number_format($midTermPoints,2),0,0,"C");
		$this->Cell(20,5,number_format($finalPoints,2),0,1,"C");
       
		$this->Cell(100,5,'Acad/Non-acad. Units: ',0,0,"R");	
		$this->Cell(20,5, $acad." / ".$nonAcad,0,0,"C");
		$this->Cell(20,5,$acad." / ".$nonAcad,0,1,"C");
		$this->Cell(100,5,'Grade Points Average: ',0,0,"R");
		$midTermAvg = ($midTermAcad == 0)? 0 :($midTermPoints/$midTermAcad);
		$finalAvg = ($finalAcad == 0)? 0 :($finalPoints/$finalAcad);
		$this->Cell(20,5,number_format($midTermAvg,2),0,0,"C");
		$this->Cell(20,5,number_format($finalAvg,2),0,1,"C");
	}

	function pageBreak(){
		$this->SetY(($this->GetPageHeight()/2)-5);
		$this->Cell(0,5,"-   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -",0,1,"C");
		$this->SetY(($this->GetPageHeight()/2)+5);
	}

	function getFullName($lastName, $firstName, $middleName){
		return $lastName.", ".$firstName." ".(isset($middleName)?substr($middleName,0,1).".": "");
	}

}

$period = $_SESSION["period"];
$syr = intval($period/10);
$studLevelID = $_SESSION['studLevelID'];
$sem = $period % 10;
$arrPeriod = array(1 => "First Semester", 2 =>"Second Semester", 
                   3 => "Summer");

// Instanciation of inherited class



//***** Print DATA*********//
$staff = new StaffModel($DB_con);

if($studLevelID == 0){
	echo "<div style='color:red'>No Gradesheet available to be print.</div>";
	exit();
}

$pdf = new PDF('P','mm','Letter');
$title = $arrPeriod[$sem]." of ".$syr;
$pdf->SetTitle($title);
$pdf->AliasNbPages();

$pdf->AddPage();

$studInfo=$staff->getStudentStanding($studLevelID, $period);
$grades = $staff->getAllGradesOfStudent($studLevelID, $period);
$pdf->Header_PDF();
$pdf->studentInfo($studInfo);
$pdf->tableHeader();
$pdf->tableBody($grades);

$pdf->Output();

?>