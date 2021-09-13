<?php
 require('fpdf16/fpdf.php'); 
 

   class PDF extends FPDF{
   	function Header()
   	{
   		//$this->Image('ink.png',10,10,10);
   		$this->SetFont('Arial','BIU',18);
   		$this->Cell(0,10,'Report Generation',0,0,'C');
   		$this->Ln(20);
   	}
   	function Footer()
   	{
   		$this->SetY(-15);
   		$this->SetFont('Arial','I',8);
   		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   	}
   	function Chapter($title)
   	{
   		$this->SetFont('Arial','',12);
   		$this->SetFillColor(200,220,255);
   		$this->Cell(0,10,$title,0,1,'L',true);
   		$this->Ln(4);
   	}
   }

   	 // cerate pdf
	 $pdf=new PDF();
	 $pdf->AliasNbPages();
	 $pdf->AddPage('P','A5');

	
	 
	 
	 $pdf->Output();
?>