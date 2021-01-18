<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_export_excel extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();

		$data['html'] = '
	    <table width="100%" cellspacing="0" cellpadding="5" border="1" style="font-size: 27px;">
	    	<tr>
	    		<th colspan="5"></th>
	    		<th style="background-color: yellow">'.$data['um'].'</th>
	    		<th style="background-color: yellow">'.$data['uk'].'</th>
	    		<th colspan="3"></th>
	    	</tr>
    		<tr style="font-weight: bold; text-align: center; background-color: #F8CBAD">
    			<th width="'.$data['width'][0].'">No</th>
    			<th width="'.$data['width'][1].'">'.$data['fn'][0].'</th>
    			<th width="'.$data['width'][2].'">'.$data['fn'][1].'</th>
    			<th width="'.$data['width'][3].'">'.$data['fn'][2].'</th>
    			<th width="'.$data['width'][4].'">'.$data['fn'][3].'</th>
    			<th width="'.$data['width'][5].'">'.$data['fn'][4].'</th>
    			<th width="'.$data['width'][6].'">'.$data['fn'][5].'</th>
    			<th width="'.$data['width'][7].'">'.$data['fn'][6].'</th>
    			<th width="'.$data['width'][8].'">'.$data['fn'][7].'</th>
    			<th width="'.$data['width'][9].'">'.$data['fn'][8].'</th>
    		</tr>';
    	$d = select($data['table'].",item",$data['field'],$data['condition']);
    	foreach ($d as $i => $r) {
    		$req = '';
    		if($r['request']!='Kosong'){
    			$req = 'Request '.$r['request'];
    		}

    		$data['html'] .= '
    		<tr>
				<td align="center">'.($i+1).'</td>
				<td>'.$req.'</td>
				<td>'.$r['tgl'].'</td>
				<td>'.$r['bukti_transaksi'].'</td>
				<td>'.$r['keterangan'].'</td>';

				if($r['tipe_uang']=='Masuk'){
	    			$data['html'] .= '
					<td>'.$r['jml_uang'].'</td>
					<td></td>';
	    		}
	    		elseif($r['tipe_uang']=='Keluar'){
	    			$data['html'] .= '
					<td></td>
					<td>'.$r['jml_uang'].'</td>';
	    		}
				
				$data['html'] .= '
				<td>'.$r['id_item'].'</td>
				<td>'.$r['nama_item'].'</td>
				<td>'.$r['pemohon'].'</td>
    		</tr>';
    	}

    	$data['html'] .= '
    		<tr style="font-weight: bold; text-align: center; background-color: #F8CBAD">
	    		<th colspan="4"></th>
	    		<th>TOTAL UANG KELUAR</th>
	    		<th></th>
	    		<th>'.$data['uk'].'</th>
	    		<th colspan="3"></th>
	    	</tr>
    	</table>';
    	
		return $data;
	}

	public function start(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'Admin',1);

		$bln = '';
		$thn = '';
		if(isset($_GET['bln']) && isset($_GET['thn'])){
			$bln = $_GET['bln'];
			$thn = $_GET['thn'];
		}

		$data['table'] = "rekap_sma";
		$data['field'] = 'id_rekap_sma,request,tgl,bukti_transaksi,keterangan,tipe_uang,jml_uang,item.id_item,nama_item,pemohon';
		$data['condition'] = "
							WHERE ".$data['table'].".id_item=item.id_item AND bln='$bln' AND thn='$thn' 
							ORDER BY request ASC, tipe_uang DESC, pemohon ASC, tipe_kwitansi ASC";
		$data['fn'] = array('Periode Request','Tanggal','Bukti Transaksi','Keterangan','Uang Masuk','Uang Keluar','No Item','Pos Anggaran','Pemohon');

		$data['width'] = array('7%','15%','15%','30%','30%','15%','15%','15%','30%','30%');


		$data['file_name'] = 'Rekap_Keuangan_SMA_'.month_name($bln).'_'.$thn;

		$r = select2($data['table'],"SUM(jml_uang) as um","WHERE tipe_uang='Masuk' AND bln='$bln' AND thn='$thn'");
		$r2 = select2($data['table'],"SUM(jml_uang) as uk","WHERE tipe_uang='Keluar' AND bln='$bln' AND thn='$thn'");
		$data['um'] = $r['um'];
		$data['uk'] = $r2['uk'];

		return $data;
	}
}