<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pages extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		
	}

	public function login($user,$pass){
		$r = select2("user","*","WHERE username='$user' AND password='$pass'");
		if(($r!=NULL) && ($r['username']==$user) && ($r['password']==$pass)){
            $data = array(
            		'ei_login' => TRUE, 
            		'ei_id' => $r['id_user'],
            		'ei_user' => $r['username'],
            		'ei_pass' => $r['password'],
            		'ei_level' => $r['level'],
            		
            		);

    		$this->session->set_userdata($data);
            return TRUE;
        }
       
        else{
        	return FALSE;
        }
	}

	public function logout(){
		$data = array('ei_login','ei_id','ei_user','ei_pass','ei_level');
		$this->session->unset_userdata($data);
    
	}

	public function header(){
	    $sLogin = $this->session->userdata('ei_login');
	    $sLevel = $this->session->userdata('ei_level');

	    if($sLogin==TRUE){
	      $data = '
	      <a href="#"><i class="fa fa-user"></i> '.$sLevel.'</a>
	      <a href="'.base_url().'pages/logout"><i class="fa fa-sign-out"></i> Logout</a>';
	    }
	    else{
	      $data = '
	      <a href="'.base_url().'pages/login">Login';
	    }
	    return $data;
	}

	public function aside(){
		$sLogin = $this->session->userdata('ei_login');
	    $sLevel = $this->session->userdata('ei_level');
	    
		$data = '';
		if($sLogin==TRUE){
			if($sLevel=='Admin'){
				$data = '
				<li>
				  <a href="'.base_url().'pages/content/user/data"><i class="fa fa-user"></i> <span class="nav-label">User</span></a>
				</li>';

				//Model pada menu
				$menu =  array(
				         array('pages'=>'pegawai','class'=>'male','name'=>'Pegawai'),
				         array('pages'=>'sasaran_kerja','class'=>'edit','name'=>'Sasaran Kerja'),
	                	 );
				$data .= '
				<li class="has-submenu">
				  <a href="#"><i class="ion-grid"></i> <span class="nav-label">Data Pegawai</span> <span class="caret pull-right m-t-10"></span></a>
				  <ul class="list-unstyled">';
				  foreach ($menu as $i => $r) {
				    $data .= '
				    <li>
				      <a href="'.base_url().'pages/content/'.$r['pages'].'/data"><i class="fa fa-'.$r['class'].'"></i> <span class="nav-label">'.$r['name'].'</span></a>
				    </li>';
				  }
				  $data .= '
				  </ul>
				</li>';

			  	$submenu =  array(
							array('pages'=>'kriteria','class'=>'table','name'=>'Kriteria'),
							array('pages'=>'notif','class'=>'bell','name'=>'Notifikasi'),
							array('pages'=>'penilaian','class'=>'edit','name'=>'Penilaian'),
							array('pages'=>'hasil','class'=>'file-pdf-o','name'=>'Riwayat'),
							
			                );
			}
			elseif($sLevel=='Kepala Bagian'){
			  	$submenu =  array(
			  				array('pages'=>'sasaran_kerja','class'=>'edit','name'=>'Sasaran Kerja'),
			                array('pages'=>'penilaian','class'=>'edit','name'=>'Penilaian'),
			                array('pages'=>'hasil','class'=>'file-pdf-o','name'=>'Riwayat'),
			                );
			}
			elseif($sLevel=='Direktur'){
			  	$submenu =  array(
			  				array('pages'=>'hasil','class'=>'file-pdf-o','name'=>'Riwayat'),
			                );
			}
			foreach ($submenu as $i => $r) {
			    $data .= '
			    <li>
			      <a href="'.base_url().'pages/content/'.$r['pages'].'/data"><i class="fa fa-'.$r['class'].'"></i> <span class="nav-label">'.$r['name'].'</span></a>
			    </li>';
		  	}
		}
		
		return $data;
	}
	//array('pages'=>'report','class'=>'file-pdf-o','name'=>'Report'),
}