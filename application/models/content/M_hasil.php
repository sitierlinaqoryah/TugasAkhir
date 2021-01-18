<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasil extends CI_Model {
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
		level_check($data['sLevel'],'Admin,Kepala Bagian,Direktur',1);

		$data['TITLE'] = 'Riwayat';
		$data['PANEL'] = '';
		$data['table'] = urinext('content');
		$data['field'] = 'id_hasil,nama,nilai';
		$data['condition'] = '';
		$data['fn'] = array('ID '.$data['TITLE'],'Nama','Nilai');
		$data['start'] = 1;
		$data['sl'] = '';
		$data['slt'] = '';
		
		$data['url'] = base_url().'pages/content/'.$data['table'].'/';
		$data['add'] = 'Add <a href="'.$data['url'].'add" class="btn btn-success"><i class="fa fa-plus"></i></a>';
		$data['back'] = 'Back <a href="'.$data['url'].'data" class="btn btn-success"><i class="fa fa-arrow-left"></i></a>';

		$data['thn'] = '';
		if(isset($_GET['thn'])){
			$data['thn'] = $_GET['thn'];
		}

		return $data;
	}

	public function data(){
		$data = $this->start();
		$data['ACTION'] = 'data';
		$title = '
		<form action="'.base_url().'report/export/export_pdf/pdf" method="post" id="commentForm2" class="form-horizontal cmxform tasi-form" novalidate="novalidate" enctype="multipart/form-data">
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
	    			<button type="submit" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Cetak</button>
	    		</div>
	  	  	</div>
		</form>';

		$ptitle = array($data['add']=$title);

		/*$body = table(
				$data['table'].",pegawai",
				$data['field'],
				$data['condition']="WHERE $data[table].nip=pegawai.nip AND tahun='$data[thn]' ORDER BY nilai DESC",
				$data['fn'],
				$data['start'],
				$data['status']='',
				'');*/

		$body = '
		<table class="table datatables table-striped table-bordered">
        	<thead>
        		<tr>
    				<th>Ranking</th>
    				<th>Nama Pegawai</th>
    				<th>Nilai</th>
    			</tr>
    		</thead>
    		<tbody>';
	    	$d = select(
				$data['table'].",pegawai",
				$data['field'],
				$data['condition']="WHERE $data[table].nip=pegawai.nip AND tahun='$data[thn]' ORDER BY nilai DESC");

	    	foreach ($d as $i => $r) {
	    		$body .= '
	    		<tr>
					<td>'.($i+1).'</td>
					<td>'.$r['nama'].'</td>
					<td>'.$r['nilai'].'</td>
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

		$extra[0] = '';
        $extra[1] = '';
		$body = form(
				$data['table'],
				$data['field'],
				$data['condition'],
				$data['fn'],
				$data['start'],
				$values='',
				$data['sl'],
				$data['slt'],
				$extra);

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
	        $values = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
	        $extra[0] = '';
	        $extra[1] = '';
			$body = form(
					$data['table'],
					$data['field'],
					$data['condition'],
					$data['fn'],
					$data['start'],
					$values,
					$data['sl'],
					$data['slt'],
					$extra);

			$pbody = array($body);
			$data['PANEL'] = panel($ptitle,$pbody);
			return $data;
		}
	}

	public function view(){
		if(!empty(urinext('view')) && !empty(urinext('id'))){
			$data = $this->start();
			$data['ACTION'] = 'view';
			$ptitle = array($data['back']);

			$id = string(urinext('id'));
	        $values = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
	        $extra[0] = '';
	        $extra[1] = '';
			$body = view(
					$data['table'],
					$data['field'],
					$data['condition'],
					$data['fn'],
					$data['start'],
					$values,
					$extra);

			$pbody = array($body);
			$data['PANEL'] = panel($ptitle,$pbody);
			return $data;
		}
	}

	public function action(){
		if(!empty(urinext('action'))){
			$data = $this->start();
			$act = urinext('action');
			$to = 'data';
			$id_new = auto_code($data['table'],"U","");
			
			$input = '';
			
			$action = action($data['table'],$data['field'],$id_new,$input,$data['start'],$act,$to);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			message($data['table'],$to,$action,$type=0,$message);
		}
	}

	public function import(){
		$data = $this->start();
	}
}