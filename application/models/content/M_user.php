<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
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

		$data['TITLE'] = 'User';
		$data['PANEL'] = '';
		$data['table'] = urinext('content');
		$data['field'] = '*';
		$data['condition'] = '';
		$data['fn'] = array('ID '.$data['TITLE'],'Username','Password','Level');
		$data['start'] = 1;
		$data['sl'] = '';
		$data['slt'] = '';
		$data['sl'][3] = array('Admin','Kepala Bagian','Direktur');
		
		$data['slt'] = array(3=>'3');
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
				'edit,delete');

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
			//$id_new = str_rand(10);

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