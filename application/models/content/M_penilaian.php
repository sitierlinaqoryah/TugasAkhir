<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penilaian extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->start();
		$this->data();
	}

	public function start(){
		$data = array();
		$data = session_check();
		level_check($data['sLevel'],'Admin,Kepala Bagian',1);

		$data['TITLE'] = 'Penilaian';
		$data['PANEL'] = '';
		$data['table'] = urinext('content');
		$data['field'] = '*';
		$data['condition'] = '';
		$data['fn'] = array('ID '.$data['TITLE'],'Nama Pegawai');
		$data['start'] = 1;
		$data['sl'] = '';
		$data['slt'] = '';
		/*$data['sl'][3] = array('Admin','Kepala Bagian','Direktur');
		$data['sl'][2] = select("kecamatan","*","");
		$data['slt'] = array(3=>'3');*/
		$data['url'] = base_url().'pages/content/'.$data['table'].'/';
		$data['add'] = 'Add <a href="'.$data['url'].'add" class="btn btn-success"><i class="fa fa-plus"></i></a>';
		$data['back'] = 'Back <a href="'.$data['url'].'data" class="btn btn-success"><i class="fa fa-arrow-left"></i></a>';

		$data['thn'] = '';
		if(isset($_GET['thn'])){
			$data['thn'] = $_GET['thn'];
		}

		$data['d1'] = select("pegawai","*","WHERE NOT EXISTS(SELECT * FROM $data[table] WHERE pegawai.nip=$data[table].nip AND tahun='$data[thn]')");
		$data['d2'] = select("kriteria","*","");

		return $data;
	}

	public function data(){
		$data = $this->start();
		$data['ACTION'] = 'data';

		$title = '
		<form action="'.base_url().'pages/content/'.$data['table'].'/add" method="get" id="commentForm2" class="form-horizontal cmxform tasi-form" novalidate="novalidate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-md-2">Tahun :</label>
                <div class="col-md-3">
                    <select class="form-control select2" data-placeholder="Select ..." name="thn" id="thn" onChange="window.location=(\''.base_url().'pages/content/'.$data['table'].'/data?thn=\'+this.value)" required>
                        <option value="">Select ...</option>';
                        foreach (year() as $i => $r) {
                        	$select = '';
                        	if($r==$data['thn'])
                        		$select = 'selected';

                            $title .= '<option value="'.$r.'" '.$select.'>'.$r.'</option>';
                        }
                        $title .= '
                    </select>
                </div>
            </div>
            <div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
	    			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>';
	    			if($data['thn']!=''){
	    				$title .= '
	    				<a href="'.base_url().'pages/content/'.$data['table'].'/view?thn='.$data['thn'].'" class="btn btn-primary"><i class="fa fa-check"></i> Proses</a>';
	    			}
	    		$title .= '
	    		</div>
	  	  	</div>
		</form>';

		$ptitle = array($data['add']=$title);

		$body = '
		<table class="table datatables table-striped table-bordered">
	        <thead>
	            <tr>
	            	<th>No</th>
	            	<th>Nama</th>';
	            	foreach ($data['d2'] as $i => $r) {
		            	$body .= '
		            	<th>'.$r['nama_kriteria'].' (C'.($i+1).')</th>';
		            }

	            $body .= '
	            	<th>Action</th>
	            </tr>
	        </thead>
	        <tbody>';
	        $data['d1'] = select("pegawai","*","WHERE EXISTS(SELECT * FROM $data[table] WHERE pegawai.nip=$data[table].nip AND tahun='$data[thn]')");
        	foreach ($data['d1'] as $i => $r) {
	        	$body .= '
	        	<tr>
	        		<td>'.($i+1).'</td>
	        		<td>'.$r['nama'].'</td>';
	        		foreach ($data['d2'] as $j => $r2) {
	        			$r3 = select2($data['table'],"nilai","WHERE nip='$r[nip]' AND id_kriteria='$r2[id_kriteria]' AND tahun='$data[thn]'");

	        			$body .= '<td>'.$r3['nilai'].'</td>';
	        		}
	        	$body .= '
	        		<td>
						<a href="'.base_url().'pages/content/'.$data['table'].'/edit/id/'.$r['nip'].'?thn='.$data['thn'].'" class="btn btn-info"><i class="fa fa-pencil"></i></a>
						<a href="'.base_url().'pages/content/'.$data['table'].'/action/delete/id/'.$r['nip'].'?thn='.$data['thn'].'" class="btn btn-danger" onClick="return confirm(\'ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?\')"><i class="fa fa-trash"></i></a>
	        		</td>
	        	</tr>';
	        }
	        $body .= '
	        </tbody>
        </table>';

		$pbody = array($body);
		$data['PANEL'] = panel($ptitle,$pbody);
		return $data;
	}

	public function add(){
		$data = $this->start();
		$data['ACTION'] = 'add';
		$ptitle = array($data['back']);

		$body = '
		<form action="'.base_url().'pages/content/'.$data['table'].'/action/add?thn='.$data['thn'].'" method="post" id="commentForm" class="form-horizontal cmxform tasi-form" novalidate="novalidate" enctype="multipart/form-data">
			<div class="form-group">
    			<label class="control-label col-lg-3">'.$data['fn'][1].' :</label>
	            <div class="col-lg-5">
	            	<input type="hidden" class="form-control" name="thn" id="thn" maxlength="4" value="'.$data['thn'].'" required>
					<select class="form-control select2" data-placeholder="Select ..." name="pgw" id="pgw" required>
                        <option value="">Select ...</option>';
                        foreach ($data['d1'] as $i => $r) {
                            $body .= '<option value="'.$r['nip'].'">'.$r['nip'].' | '.$r['nama'].'</option>';
                        }
                        $body .= '
                    </select>
	            </div>
	        </div><br>
	        <h4 style="font-weight: bold; color: red;">Kriteria</h4>';

	        foreach ($data['d2'] as $i => $r) {
		        $body .= '
		        <div class="form-group">
	    			<label class="control-label col-lg-3">'.$r['nama_kriteria'].' :</label>
		            <div class="col-lg-5">
						<input type="text" class="form-control" name="input_'.$i.'" id="input_'.$i.'" maxlength="4" value="" onkeypress="return number_point(event)" required>
		            </div>
		        </div>';
		    }

	        $body .= '
	        <br><br>
	    	<div class="form-group">
				<div class="col-lg-offset-3 col-lg-10">
	    			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
	    		</div>
	  	  	</div>
		</form>';

		$pbody = array($body);
		$data['PANEL'] = panel($ptitle,$pbody);
		return $data;
	}

	public function edit(){
		if(!empty(urinext('edit')) && !empty(urinext('id'))){
			$data = $this->start();
			$data['ACTION'] = 'edit';
			$ptitle = array($data['back']);

			$id = string(urinext('id'));

			$r = select2("pegawai","nama","WHERE nip='$id'");
			$body = '
			<form action="'.base_url().'pages/content/'.$data['table'].'/action/edit/id/'.$id.'?thn='.$data['thn'].'" method="post" id="commentForm" class="form-horizontal cmxform tasi-form" novalidate="novalidate" enctype="multipart/form-data">
				<div class="form-group">
	    			<label class="control-label col-lg-3">'.$data['fn'][1].' :</label>
		            <div class="col-lg-5">
		            	<input type="hidden" class="form-control" name="thn" id="thn" value="'.$data['thn'].'">
		            	<input type="hidden" class="form-control" name="pgw" id="pgw" value="'.$id.'">
		            	<input type="text" class="form-control" name="npgw" id="npgw" value="'.$r['nama'].'" disabled>
		            </div>
		        </div><br>
		        <h4 style="font-weight: bold; color: red;">Kriteria</h4>';

		        foreach ($data['d2'] as $i => $r) {
		        	$r2 = select2($data['table'],"nilai","WHERE nip='$id' AND id_kriteria='$r[id_kriteria]' AND tahun='$data[thn]'");
			        $body .= '
			        <div class="form-group">
		    			<label class="control-label col-lg-3">'.$r['nama_kriteria'].' :</label>
			            <div class="col-lg-5">
							<input type="text" class="form-control" name="input_'.$i.'" id="input_'.$i.'" maxlength="4" value="'.$r2['nilai'].'" onkeypress="return number_point(event)" required>
			            </div>
			        </div>';
			    }

		        $body .= '
		        <br><br>
		    	<div class="form-group">
					<div class="col-lg-offset-3 col-lg-10">
		    			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
		    		</div>
		  	  	</div>
			</form>';

			$pbody = array($body);
			$data['PANEL'] = panel($ptitle,$pbody);
			return $data;
		}
	}

	public function view(){
		//if(!empty(urinext('view')) && !empty(urinext('id'))){
		$data = $this->start();
		$data['ACTION'] = 'view';
		$ptitle = array($data['back']);

		$body = '
        <h5 style="font-weight: bold; color: red;">Ranking</h5>
		<table class="table datatables table-striped table-bordered">
        	<thead>
        		<tr>
    				<th>Ranking</th>
    				<th>Nama Pegawai</th>
    				<th>Nilai</th>
    			</tr>
    		</thead>
    		<tbody>';
	    	$d = select("hasil,pegawai","*","WHERE hasil.nip=pegawai.nip AND tahun='$data[thn]' ORDER BY nilai DESC");

	    	foreach ($d as $i => $r) {
	    		$color = '';
        		if($i==0){
        			$color = 'style="background-color: #1ca8dd; color: white;"';
        		}
	    		$body .= '
	    		<tr '.$color.'>
					<td>'.($i+1).'</td>
					<td>'.$r['nama'].'</td>
					<td>'.$r['nilai'].'</td>
	    		</tr>';
	    	}
    	$body .= '
    		</tbody>
    	</table>
    	<br>
		<h5 style="font-weight: bold; color: red;">Tabel Nilai Pegawai</h5>
		<table class="table datatables table-striped table-bordered">
	        <thead>
	            <tr>
	            	<th>No</th>
	            	<th>Nama</th>';
	            	foreach ($data['d2'] as $i => $r) {
		            	$body .= '
		            	<th>'.$r['nama_kriteria'].' (C'.($i+1).')</th>';
		            }

	            $body .= '
	            </tr>
	        </thead>
	        <tbody>';
	        $data['d1'] = select("pegawai","*","WHERE EXISTS(SELECT * FROM $data[table] WHERE pegawai.nip=$data[table].nip AND tahun='$data[thn]')");
	        $nilai = array();
        	foreach ($data['d1'] as $i => $r) {
	        	$body .= '
	        	<tr>
	        		<td>'.($i+1).'</td>
	        		<td>'.$r['nama'].'</td>';
	        		foreach ($data['d2'] as $j => $r2) {
	        			$r3 = select2($data['table'],"nilai","WHERE nip='$r[nip]' AND id_kriteria='$r2[id_kriteria]' AND tahun='$data[thn]'");

	        			$body .= '<td>'.$r3['nilai'].'</td>';
	        			$nilai[$i][$j] = $r3['nilai'];
	        		}
	        	$body .= '
	        	</tr>';
	        }
	        $body .= '
	        </tbody>
        </table>';
        foreach ($data['d2'] as $j => $r2) {
            foreach ($data['d1'] as $i => $r) {
                $alt[$i] = $nilai[$i][$j];
            }
            $min[$j] = min($alt);
            $max[$j] = max($alt);
            unset($alt);
        }
        $body .= '
        <br>
        <h5 style="font-weight: bold; color: red;">Tabel Nilai Utility</h5>
		<table class="table datatables table-striped table-bordered">
	        <thead>
	            <tr>
	            	<th>No</th>
	            	<th>Nama</th>';
	            	foreach ($data['d2'] as $i => $r) {
		            	$body .= '
		            	<th>'.$r['nama_kriteria'].' (C'.($i+1).')</th>';
		            }

	            $body .= '
	            </tr>
	        </thead>
	        <tbody>';
        	foreach ($data['d1'] as $i => $r) {
	        	$body .= '
	        	<tr>
	        		<td>'.($i+1).'</td>
	        		<td>'.$r['nama'].'</td>';
	        		foreach ($data['d2'] as $j => $r2) {
	        			if(($max[$j]-$min[$j])!=0)
	        				$nu[$i][$j] = ($max[$j]-$nilai[$i][$j])/($max[$j]-$min[$j]);
	        			else
	        				$nu[$i][$j] = 0;
	        			$body .= '<td>'.$nu[$i][$j].'</td>';
	        		}
	        	$body .= '
	        	</tr>';
	        }
	        $body .= '
	        </tbody>
        </table>
        <br>
        <h5 style="font-weight: bold; color: red;">Tabel Nilai Akhir Masing2 Alternatif</h5>';

        foreach ($data['d1'] as $i => $r) {
        	$nip = $r['nip'];
	        $body .= '
	        <div class="row">
	            <div class="col-lg-12">
	                <div class="portlet">
	                    <div class="portlet-heading bg-info">
	                        <h3 class="portlet-title">'.$r['nama'].'</h3>
	                        <div class="portlet-widgets">
	                            <a data-toggle="collapse" data-parent="#accordion1" href="#bg-info'.$i.'"><i class="fa fa-plus"></i></a>
	                            <span class="divider"></span>
	                        </div>
	                        <div class="clearfix"></div>
	                    </div>
	                    <div id="bg-info'.$i.'" class="panel-collapse collapse out">
	                        <div class="portlet-body">
	                            <table class="table datatables table-striped table-bordered">
						        <thead>
						            <tr>
						            	<th>No</th>
						            	<th>Kriteria</th>
						            	<th>Faktor Evaluasi</th>
						            	<th>Faktor Bobot</th>
						            	<th>Evaluasi Bobot</th>
						            </tr>
						        </thead>
						        <tbody>';
						        $t_fe = 0;
						        $t_fb = 0;
						        $t_eb = 0;
					        	foreach ($data['d2'] as $j => $r2) {
					        		$fe = $nu[$i][$j]*100;
					        		$fb = $r2['bobot']/100;
					        		$eb = $fe*$fb;
						        	$body .= '
						        	<tr>
						        		<td>'.($j+1).'</td>
						        		<td>'.$r2['nama_kriteria'].'</td>
						        		<td>'.number_format($fe,2).'</td>
						        		<td>'.$fb.'</td>
						        		<td>'.number_format($eb,2).'</td>
						        	</tr>';
						        	$t_fe += $fe;
						        	$t_fb += $fb;
						        	$t_eb += $eb;
						        }
						        $total[$nip] = $t_eb;
						        $body .= '
						        </tbody>
						        <tfoot>
						        	<tr>
						        		<th></th>
						        		<th>Total</th>
						        		<th>'.number_format($t_fe,2).'</th>
						        		<th>'.$t_fb.'</th>
						        		<th>'.number_format($t_eb,2).'</th>
						        	</tr>
						        </tfoot>
					        </table>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>';
	    }

	    /*$body .= '
	    <br>
        <h5 style="font-weight: bold; color: red;">Ranking</h5>
		<table class="table datatables table-striped table-bordered">
	        <thead>
	            <tr>
	            	<th>Ranking</th>
	            	<th>Nama</th>
	            	<th>Nilai</th>
	            </tr>
	        </thead>
	        <tbody>';*/
	        arsort($total);
	        $no = 1;
        	foreach ($total as $i => $r) {
        		$r2 = select2("pegawai","nama","WHERE nip='$i'");
        		/*$color = '';
        		if($no==1){
        			$color = 'style="background-color: #1ca8dd; color: white;"';
        		}*/

        		$n = number_format($r,2);
	        	/*$body .= '
	        	<tr '.$color.'>
	        		<td>'.$no.'</td>
	        		<td>'.$r2['nama'].'</td>
	        		<td>'.$n.'</td>
	        	</tr>';*/
	        	$r3 = select2("hasil","*","WHERE nip='$i' AND tahun='$data[thn]'");
	        	if($r3==NULL){
	        		$id_new = str_rand(10);
	        		insert("hasil","","'$id_new','$i','$n','$data[thn]'");
	        	}
	        	$no++;
	        }
	        /*$body .= '
	        </tbody>
        </table>';*/

		$pbody = array($body);
		$data['PANEL'] = panel($ptitle,$pbody);
		return $data;
		//}
	}

	public function action(){
		if(!empty(urinext('action'))){
			$data = $this->start();
			$act = urinext('action');
			$to = 'data?thn='.$data['thn'];
			//$id_new = auto_code($data['table'],"U","");
			//$id_new = str_rand(10);

			$input = '';
			if($act=='add' || $act=='edit'){
				$input = array();
				$input[1] = $this->input->post('thn');
				$input[2] = $this->input->post('pgw');

				foreach ($data['d2'] as $i => $r) {
					$id_new = str_rand(10);
					$n = $this->input->post('input_'.$i);

					$r2 = select2($data['table'],"nilai","WHERE nip='$input[2]' AND id_kriteria='$r[id_kriteria]' AND tahun='$input[1]'");

					if($r2==NULL){
						$action = insert($data['table'],"","'$id_new','$input[2]','$r[id_kriteria]','$n','$input[1]'");
					}
					else{
						$action = update($data['table'],"nilai='$n'","WHERE nip='$input[2]' AND id_kriteria='$r[id_kriteria]' AND tahun='$input[1]'");
					}
				}
			}
			elseif($act=='delete'){
				$id = urinext('id');
				$action = delete($data['table'],"WHERE nip='$id' AND tahun='$_GET[thn]'");
			}

			//$action = action($data['table'],$data['field'],$id_new,$input,$data['start'],$act,$to);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			message($data['table'],$to,$action,$type=0,$message);
		}
	}

	public function import(){
		$data = $this->start();
	}
}