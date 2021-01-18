<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_export_pdf extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();
		//$periode = $this->input->post('prd');
		$data['title'][1] = 'Tahun '.$data['thn'];
		$data['file_name'] = 'Hasil_Penilaian_'.$data['thn'];

		/*$data['html'] = report($data['table'].",calon_penerima",
						$data['field'],
						$data['condition'],
						$data['fn'],$data['start'],$data['width'],$data['title']);*/

		$data['html'] = '
		<table width="100%" cellspacing="0" cellpadding="1" border="0">
	      	<tr>
				<td align="center" width="15%"><img src="'.base_url().'img/logo.png" width="100" height="100"></td>
				<td align="center" width="85%" style="font-weight: bold; font-size: 17px;">
					'.$data['title'][0].'
				</td>
	      	</tr>
	      	<tr>
	        	<td colspan="2"><hr></td>
	      	</tr>
	    </table>
	    <h4 align="center">'.$data['title'][1].'</h4>
	    <table width="100%" cellspacing="0" cellpadding="5" border="1">
    		<tr style="font-weight: bold; text-align: center;">
    			<th width="'.$data['width'][0].'">Ranking</th>';
    			foreach ($data['fn'] as $i => $r) {
    				$data['html'] .= '
    				<th width="'.$data['width'][$i+1].'">'.$r.'</th>';
    			}
    		$data['html'] .= '
    		</tr>';

    	$d = select(
			$data['table'].",pegawai",
			$data['field'],
			$data['condition']);
    	foreach ($d as $i => $r) {
    		$data['html'] .= '
    		<tr>
				<td align="center">'.($i+1).'</td>
				<td>'.$r['nama'].'</td>
				<td align="center">'.$r['nilai'].'</td>
    		</tr>';
    	}
    	$data['html'] .= '
    	</table>';
    	
		return $data;
	}

	public function start(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'Admin',1);

		$data['thn'] = '';
		if(isset($_POST['thn'])){
			$data['thn'] = $_POST['thn'];
		}

		$data['table'] = "hasil";
		$data['field'] = "*";
		$data['condition'] = "WHERE $data[table].nip=pegawai.nip AND tahun='$data[thn]' ORDER BY nilai DESC";
		$data['fn'] = array('Nama Pegawai','Nilai');
		$data['width'] = array('12%','60%','28%');
		$data['start'] = 0;
		
		$data['orientation'] = 'P';
		$data['format'] = 'A4';
		$data['font_size'] = 10;
		$data['title'][0] = '
		<h2>POLTEKKES KEMENKES RIAU </h2>
    	<br style="font-size: 15px;">
    	HASIL PENILAIAN PEGAWAI '.$data['thn'].'
    	';

		return $data;
	}
}