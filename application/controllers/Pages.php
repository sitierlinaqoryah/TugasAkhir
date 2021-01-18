<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
		$this->load->model('M_pages');
	}

	public function index()
	{
		$this->login();
		//$this->content('home');
	}

	public function login()
	{
		$data = array();
		$data['BASE_URL'] = base_url();
		$data['MESSAGE'] = '';
        if($this->input->post('btnLogin')=='login'){
        	$user = string($this->input->post('user'));
			$pass = string($this->input->post('pass'));

			if(!empty($user) && !empty($pass)){
				$action = $this->M_pages->login($user,$pass);

				if($action){
					redirect('pages/content/home');
				}
				else{
					$data['MESSAGE'] = '
					<script>window.alert("Login Gagal");
                    window.location=("'.$data['BASE_URL'].'pages/login")</script>';
				}
			}
        }
        $this->parser->parse('v_login',$data);
	}

	public function logout()
	{
		$this->M_pages->logout();
		redirect('pages/login');
		//redirect('pages/content/home');
	}


	public function content($content='')
	{
		session_check();
		$data = array();
		$action_type = array('data','add','edit','view','action','import');
		$action = urinext($content);
		// $this->M_pages UNTUK MEMANGGIL DATA DI MODEL TERHADAP MENU
		$data['MENU_DD'] = $this->M_pages->header();
		$data['MENU'] = $this->M_pages->aside();
		if($content=='home'){
			pages($content,$data);
		}
	    elseif(!empty($content) && !empty($action) && in_array($action,$action_type)){
	    	$model = 'M_'.$content;
	    	$this->load->model('content/'.$model);
			$data = $this->$model->$action();
			$data['MENU_DD'] = $this->M_pages->header();
			$data['MENU'] = $this->M_pages->aside();
		    pages('content',$data);
	    }
	}
}
