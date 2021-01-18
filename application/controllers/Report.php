<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent:: __construct();
	}

	public function index()
	{
		
	}

	public function export($export='')
	{
		session_check();
		$data = array();
		$action_type = array('pdf','excel');
		$action = urinext($export);
	    if(!empty($export) && !empty($action) && in_array($action,$action_type)){
	    	$model = 'M_'.$export;
	    	$this->load->model('export/'.$model);
			$data = $this->$model->index();
			if($action=='pdf'){
				$this->load->view('v_report_pdf', $data);
			}
			elseif($action=='excel'){
				$this->load->view('v_report_excel', $data);
			}
	    }
	}
}
