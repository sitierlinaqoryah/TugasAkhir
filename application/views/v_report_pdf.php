<?php
ob_start();
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('themes/assets/tcpdf/config/tcpdf_config.php');
require_once('themes/assets/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set footer fonts
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
$pdf->SetMargins(10, 5, 10);
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'themes/assets/tcpdf/examples/lang/eng.php')) {
	require_once(dirname(__FILE__).'themes/assets/tcpdf/examples/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
//$pdf->SetFont('dejavusans', 'B', 10);

// add a page
/*$orientation = 'P';
$format = 'A4';*/
$keepmargins = false;
$tocpage = false;
$pdf->AddPage($orientation, $format, $keepmargins, $tocpage);
//$pdf->SetFont('dejavusans', '', 10);
$pdf->SetFont('dejavusans', '', $font_size);

// -----------------------------------------------------------------------------

$pdf->writeHTML($html, true, false, false, false, '');
//$pdf->writeHTMLCell(0,0,0,0, $tbl, 0, 0, false, 'C', false, false);

// -----------------------------------------------------------------------------

//Close and output PDF document
ob_end_clean();
$pdf->Output($file_name.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+