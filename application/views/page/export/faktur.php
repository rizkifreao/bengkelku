<?php
// $this->apdf = new PDF();

// $this->apdf->setFilename($filename);

$this->apdf->fpdf('P','mm','A4');
$this->apdf->AliasNbPages();
$this->apdf->AddPage();


//HEADER
$this->apdf->setMargins(20,0);
$this->apdf->Ln(-10);
$this->apdf->SetFont('Arial','B',12);
$this->apdf->Cell(0,6,$filename." #".$data->nomorfaktur,0,2,'C');
$this->apdf->Ln();

//Content
$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Nama Pemilik",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".$rowCust->nama_pemilik,0,0,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(20,6,"No Polisi",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$rowCust->nopolisi,0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Alamat Rumah",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".$rowCust->alamat,0,0,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(20,6,"Jenis",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$this->M_mst_jenis->getDetail($rowCust->jenisid)->nama,0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"No Telepon",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".$rowCust->notelp,0,0,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(20,6,"Merk",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$this->M_mst_merk->getDetail($rowCust->merkid)->nama,0,1,'L');
$this->apdf->Ln(5);

// ======================================
$this->apdf->SetLineWidth(0.5);
$this->apdf->Cell(0,3,'','B',1,'C');
$this->apdf->Ln(5);

$this->apdf->SetFont('Helvetica','B',8);
$this->apdf->SetHeader();
$this->apdf->SetFillColor(238,238,238);
$this->apdf->SetWidths(array(7,110,15,38));
$this->apdf->Row(array(
				'No',
				'Sparepart',
				'Jumlah',
				'Sub Total'
));


$no=1;
$this->apdf->SetFont('Helvetica','',8);
$this->apdf->SetAligns(array("C","L","C","R"));
$sumTotal = 0;
foreach($rowDetailWo as $data){	
	$this->apdf->Row(array(
					$no++,
					$this->M_sparepart->getDetail($data->sparepartid)->nama,
					$data->qty,
					number_format($data->total,0,",",".")
	));	
	$sumTotal += $data->total;
}

$this->apdf->SetWidths(array(132,38));
$this->apdf->SetAligns(array("R"));
$this->apdf->Row(array("Total",number_format($sumTotal,0,",",".")));
?>
