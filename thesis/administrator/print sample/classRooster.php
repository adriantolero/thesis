<?php
require('../fpdf181/fpdf.php');
include_once '../Model/Config.php';
include_once '../Model/StaffModel.php';
	

class PDF extends FPDF{
	public $department = "";
	function Header()
	{
		global $title;
	    $this->SetFont('Arial','B',13);
	    $this->Cell(0,5,'VISAYAS STATE UNIVERSITY',0,1,'C');
	    $this->SetFont('Arial','b',8);
	    $this->Cell(0,5,'VISCA, Baybay City, Leyte 6521-A',0,1,'C');
	    $this->SetFont('helvetica','',11);
	    $this->Cell(0,8,$this->department,0,1,'C');
	    $this->SetFont('helvetica','B',10);
	    $this->Cell(0,7,'C L A S S  R O O S T E R',0,1,'C');
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

	public function setDepartment($str){
		$this->department =$str;
	}

	function SubjectInfo($info){
		$this->SetFont('Times','B',10);
		$this->Cell(55,5,'Offering No: '.$info['offerNum'],0,0);
		$this->Cell(60,5,'Units: '.$info['units'],0,1);
		$this->Cell(0,5,'Subject: '.$info['subDesc'],0,1);
		$this->Cell(0,5,'Instructor: '.$info['instructor'],0,1);
		$this->Cell(0,5,'Class Schedule: '.$info['schedule'],0,1);
		$this->Cell(0,5,'Department: '.$info['department'],0,1);
		$this->Cell(0,5,'Room: '.$info['room'],0,1);
		$this->Ln(2);
	}

	function tableHeader(){
		$hy = 6;
		$this->Cell(10,$hy,'No',1,0,'C');
		$this->Cell(30,$hy,'Student ID',1,0, 'C');
		$this->Cell(85,$hy,'Name',1,0, 'C');
		$this->Cell(35,$hy,'Course',1,0, 'C');
		$this->Cell(0,$hy,'Year',1,1,'C');
	}
	function tableBody($ctr, $student){
		$hy = 6;

		$studentName = $this->getFullName($student['LastName'], $student['FirstName'], null);
		$this->SetFont('Times','',9);
		$this->Cell(10,$hy,$ctr,1,0);
		$this->Cell(30,$hy,$student['StudID'],1,0);
		$this->Cell(85,$hy,$studentName,1,0);
		$this->Cell(35,$hy,$student['crsCode'],1,0,'C');
		$this->Cell(0,$hy,$student['yrLevel'],1,1,'C');
	}

	function getFullName($lastName, $firstName, $middleName){
		return $lastName.", ".$firstName." ".(isset($middleName)?substr($middleName,0,1).".": "");
	}

}

$period = $_SESSION["period"];
$syr = intval($period/10);
$deptID = $_SESSION['deptID'];
$sem = $period % 10;
$arrPeriod = array(1 => "First Semester", 2 =>"Second Semester", 
                   3 => "Summer");

// Instanciation of inherited class



//***** Print DATA*********//
$staff = new StaffModel($DB_con);
$instList = $staff->getInstructorListByDept($deptID);

if($instList == 0 || count($instList)==0){
	echo "<div style='color:red'>No Gradesheet available to be print.</div>";
	exit();
}
$pdf = new PDF('P','mm','Letter');
$title = $arrPeriod[$sem]." of ".$syr;
$department = $staff->getDept($deptID)['deptDesc'];
$pdf->setDepartment($department);
$pdf->SetTitle($title);
$pdf->AliasNbPages();
foreach ($instList as $instructor){
	$subjectList = $staff->getSubjectListByStaff($instructor['instID'], $period);
	//print_r($subjectList);exit;
	foreach ($subjectList as $subject){
		if($subject['subType'] == "Lec"){
			$pdf->AddPage();
			$info = $staff->getSubjectInfo($subject['offerID'], $period);
			//print_r($info);exit;
			$subjectInfo = array(
					'offerNum' => $info['offerNum'],
					'units' => $info['units'],
					'subDesc' => $info['subCode']." - ".$info['subDesc'],
					'instructor' => $instructor['fName']." ".$instructor['lName'],
					'schedule' => $info['days']." (".$info['strtTime']." - ".$info['endTime'].")",
					'department' => $info['deptDesc'],
					'room' => $info['room']
				);
			$student = $staff->getClassByOfferNo($subject['offerID'], $period)['body'];
			//print_r($student);exit;
			$pdf->SubjectInfo($subjectInfo);
			$pdf->tableHeader();
			if(count($student) > 0 || $student != 0){
				$ctr = 0;
				foreach ($student as $stud) {
					$ctr++;
					$pdf->tableBody($ctr, $stud);
				}
			}
			
		}
	}
}
$pdf->Output();

?>