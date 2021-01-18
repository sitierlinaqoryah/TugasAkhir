<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pegawai extends CI_Model {
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
		level_check($data['sLevel'],'Admin',1);

		$data['TITLE'] = 'Data Pegawai';
		$data['PANEL'] = '';
		$data['table'] = urinext('content');
		$data['field'] = '*';
		$data['condition'] = '';
		$data['fn'] = array('NIP','Nama '.$data['TITLE'],'Tempat Lahir','Tgl Lahir','Pangkat (Gol)','Pangkat (TMT)','Jabatan (Nama)','Jabatan (Kls)','Jabatan (TMT)','Masa Kerja Jabatan (Thn)','Masa Kerja Jabatan (Bln)','Eselon','TMT CPNS','Masa Kerja (Thn)','Masa Kerja (Bln)','Usia (Thn)','Usia (Bln)','Latihan Jabatan Struktural (Nama)','Latihan Jabatan Struktural (Thn)','Pendidikan (Nama)','Pendidikan (Lulus)','Pendididikan (Tingkat Ijazah)');
		$data['start'] = 0;
		$data['sl'] = '';
		$data['slt'] = '';
		$data['sl'][21] = array('S1','S2','S3');
	
		$data['slt'] = array(21=>'3');
		$data['url'] = base_url().'pages/content/'.$data['table'].'/';
		$data['add'] = 'Add <a href="'.$data['url'].'add" class="btn btn-success"><i class="fa fa-plus"></i></a>';
		$data['back'] = 'Back <a href="'.$data['url'].'data" class="btn btn-success"><i class="fa fa-arrow-left"></i></a>';
		return $data;
	}

	public function data(){
		$data = $this->start();
		$data['ACTION'] = 'data';

		$ptitle = array($data['add']);

		$body = table(
				$data['table'],
				$data['field'],
				$data['condition'],
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
	        $values = select2($data['table'],$data['field'],"WHERE nip='$id'");
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
	        $values = select2($data['table'],$data['field'],"WHERE nip='$id'");
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
			
			$input = '';
			
			$action = action($data['table'],$data['field'],$id_new='',$input,$data['start'],$act,$to);
			$message[0] = 'Success';
			$message[1] = 'Failed';
			message($data['table'],$to,$action,$type=0,$message);
		}
	}

	public function import(){
		$data = $this->start();
	}
}