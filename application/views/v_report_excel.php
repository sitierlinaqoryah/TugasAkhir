<?php
// Fungsi header dengan mengirimkan raw data excel
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xlsx"
header('Content-Disposition: attachment; filename='.$file_name.'.xls');
//header('Content-Length:'. filesize($file_name.'.xlsx'));
/*header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');*/

echo $html;
?>