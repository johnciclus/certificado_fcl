<?php
	require_once('scripts/tcpdf/config/lang/spa.php');
	require_once('scripts/tcpdf/tcpdf.php');
	
	# capture, replacce any spaces w/ plusses, and decode
	$encoded = $_POST['imgdata'];
	$encoded = str_replace(' ', '+', $encoded);
	$decoded = base64_decode($encoded);
	
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Festival de la Cultura Libre');
	$pdf->SetTitle('Certificado');
	$pdf->SetSubject('Certificado de asistencia');
	$pdf->SetKeywords('Festival, Cultura, Libre, Certificado');
	
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(0);
	$pdf->SetFooterMargin(0);
	
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	$pdf->setLanguageArray($l);
	
	$pdf->AddPage('L', 'A4');
	
	$pdf->Image('@'.$decoded, 40, 22, 0, 0 , '', '', '', false, 300);
		
	$pdf->Output('certificados/' . $_POST['name'] . '.pdf', 'F');
?>