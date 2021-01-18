<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sasaran_kerja extends CI_Model {
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

		$data['TITLE'] = 'Sasaran Kerja';
		$data['PANEL'] = '';
		$data['table'] = urinext('content');
		$data['field'] = 'id_sk,nama_sk,ak1,target_kuant,target_kual,target_waktu,target_biaya,ak2,real_kuant,real_kual,real_waktu,real_biaya';
		$data['condition'] = '';
		$data['fn'] = array('ID '.$data['TITLE'],$data['TITLE'].' Yang Akan Dicapai','AK','Target Kuant/Output','Target Kual/Mutu','Target Waktu (Bulan)','Target Biaya','AK','Realisasi Kuant/Output','Realisasi Kual/Mutu','Realisasi Waktu (Bulan)','Realisasi Biaya');
		$data['start'] = 1;
		$data['sl'] = '';
		$data['slt'] = '';
		
		$data['url'] = base_url().'pages/content/'.$data['table'].'/';
		$data['add'] = 'Add <a href="'.$data['url'].'add" class="btn btn-success"><i class="fa fa-plus"></i></a>';
		$data['back'] = 'Back <a href="'.$data['url'].'data" class="btn btn-success"><i class="fa fa-arrow-left"></i></a>';

		$data['nip'] = '';
		if(isset($_GET['nip'])){
			$data['nip'] = $_GET['nip'];
		}

		$data['d1'] = select("pegawai","*","");

		return $data;
	}

	public function data(){
		$data = $this->start();
		$data['ACTION'] = 'data';
		$title = '
		<form action="'.base_url().'pages/content/'.$data['table'].'/add" method="get" id="commentForm2" class="form-horizontal cmxform tasi-form" novalidate="novalidate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-md-3">Pegawai :</label>
                <div class="col-md-5">
                    <select class="form-control select2" data-placeholder="Select ..." name="nip" id="nip" onChange="window.location=(\''.base_url().'pages/content/'.$data['table'].'/data?nip=\'+this.value)" required>
                        <option value="">Select ...</option>';
                        foreach ($data['d1'] as $i => $r) {
                        	$select = '';
                        	if($r['nip']==$data['nip'])
                        		$select = 'selected';

                            $title .= '<option value="'.$r['nip'].'" '.$select.'>'.$r['nama'].'</option>';
                        }
                        $title .= '
                    </select>
                </div>
            </div>
            <div class="form-group">
				<div class="col-lg-offset-3 col-lg-10">
	    			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
	    		</div>
	  	  	</div>
		</form>';
		$ptitle = array($data['add']=$title);

		$body = table(
				$data['table'],
				$data['field'],
				$data['condition']="WHERE nip='$data[nip]'",
				$data['fn'],
				$data['start'],
				$data['status']='',
				'view,edit,delete');

		$pbody = array($body);
		$data['PANEL'] = panel($ptitle,$pbody);
		return $data;
	}

	public function add(){
		$data = $this->start();
		$data['ACTION'] = 'add';
		$ptitle = array($data['back']);

		$extra[0] = '';
        $extra[1] = '<input type="hidden" name="input_12" id="input_12" value="'.$data['nip'].'">';
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
			$r = select2($data['table'],"nip","WHERE id_sk='$id'");
	        $values = select2($data['table'],$data['field'],"WHERE id_sk='$id'");
	        $extra[0] = '';
	        $extra[1] = '<input type="hidden" name="input_12" id="input_12" value="'.$r['nip'].'">';
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
	        $values = select2($data['table'],$data['field'],"WHERE id_sk='$id'");
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
			//$id_new = auto_code($data['table'],"SK","");
			$id_new = str_rand(10);

			$input = '';
			if($act=='add' || $act=='edit'){
				/*$input = array();
				$input[1] = $this->input->post('input_1');
				$input[2] = $this->input->post('input_2');
				$input[3] = $this->input->post('input_3');*/
				$to .= '?nip='.$this->input->post('input_12');
			}

			$action = action($data['table'],$data['field']="*",$id_new,$input,$data['start'],$act,$to);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			message($data['table'],$to,$action,$type=0,$message);
		}
	}

	public function import(){
		$data = $this->start();
	}
}