<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {
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
		level_check($data['sLevel'],'Admin,Surveyor',1);

		$data['TITLE'] = 'Report';
		$data['PANEL'] = '';
		$data['table'] = urinext('content');
		$data['field'] = '*';
		$data['condition'] = '';
		$data['fn'] = array('ID '.$data['TITLE']);
		$data['start'] = 1;
		
		$data['sl'] = '';
		$data['slt'] = '';
		$data['url'] = base_url().'pages/content/'.$data['table'].'/';
		$data['add'] = 'Add <a href="'.$data['url'].'add" class="btn btn-success"><i class="fa fa-plus"></i></a>';
		$data['back'] = 'Back <a href="'.$data['url'].'data" class="btn btn-success"><i class="fa fa-arrow-left"></i></a>';
		return $data;
	}

	public function data(){
		$data = $this->start();
		$data['ACTION'] = 'data';

		$ptitle = array(
                'Laporan Rekap SMP',
                'Laporan Rekap SMA');

		for($i=0; $i<=1; $i++){
			$pbody[$i] = '
			<form action="'.base_url().'report/export/export'.($i+1).'/excel" method="post" id="commentForm'.($i+1).'" class="form-horizontal cmxform tasi-form" novalidate="novalidate" enctype="multipart/form-data">
	            <div class="form-group">
	                <label class="control-label col-md-2">Bulan :</label>
	                <div class="col-md-3">
	                    <select class="form-control select2" data-placeholder="Select ..." name="bln" id="bln" required>
	                        <option value="">Select ...</option>';
	                        foreach (month() as $j => $r) {
	                        	$select = '';
	                        	if(isset($_GET['bln'])){
	                        		if($r['bln']==$_GET['bln'])
	                        			$select = 'selected';
	                        	}
	                            $pbody[$i] .= '<option value="'.$j.'" '.$select.'>'.$r.'</option>';
	                        }
	                        $pbody[$i] .= '
	                    </select>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="control-label col-md-2">Tahun :</label>
	                <div class="col-md-3">
	                    <select class="form-control select2" data-placeholder="Select ..." name="thn" id="thn" required>
	                        <option value="">Select ...</option>';
	                        foreach (year() as $j => $r) {
	                        	$select = '';
	                        	if(isset($_GET['thn'])){
	                        		if($r['thn']==$_GET['thn'])
	                        			$select = 'selected';
	                        	}
	                            $pbody[$i] .= '<option value="'.$r.'" '.$select.'>'.$r.'</option>';
	                        }
	                        $pbody[$i] .= '
	                    </select>
	                </div>
	            </div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
		    			<button type="submit" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Report</button>
		    		</div>
		  	  	</div>
			</form>';
		}
		//$pbody = array($body);
		$data['PANEL'] = panel($ptitle,$pbody);
		return $data;
	}

	public function add(){
		$data = $this->start();
		return $data;
	}

	public function edit(){
		if(!empty(urinext('edit')) && !empty(urinext('id'))){
			$data = $this->start();
			return $data;
		}
	}

	public function view(){
        if(!empty(urinext('view')) && !empty(urinext('id'))){
    		$data = $this->start();
    		return $data;
        }
	}

	public function action(){
		if(!empty(urinext('action'))){
			$data = $this->start();
		}
	}

	public function import(){
		$data = $this->start();
	}
}