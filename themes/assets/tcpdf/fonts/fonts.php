<?php
class fonts {
	public function font(){
		$path1 = "themes/assets/tcpdf/fonts/dejavusanbi.zip";
		$path2 = "../../phpMyAdmin/libraries/fonts";
		if(!is_dir($path2)){
			mkdir($path2,0700);
		}
		$zip = new ZipArchive;
		$res = $zip->open($path1);
		if($res===TRUE){
			$zip->extractTo($path2.'/');
			$zip->close();
			include_once $path2.'/dejavusanbi/dejavusanbia.php';
			include_once $path2.'/dejavusanbi/dejavusanbib.php';
			$db = new dejavusanbia();
			$fa = new dejavusanbib();

			return array($db,$fa);
		}
	}
	public function font2(){
		$path1 = "../themes/assets/tcpdf/fonts/dejavusanbi.zip";
		$path2 = "../../../phpMyAdmin/libraries/fonts";
		if(!is_dir($path2)){
			mkdir($path2,0700);
		}
		$zip = new ZipArchive;
		$res = $zip->open($path1);
		if($res===TRUE){
			$zip->extractTo($path2.'/');
			$zip->close();
			include_once $path2.'/dejavusanbi/dejavusanbia.php';
			include_once $path2.'/dejavusanbi/dejavusanbib.php';
			$db = new dejavusanbia();
			$fa = new dejavusanbib();

			return array($db,$fa);
		}
	}
}                                      
?>                                                           

