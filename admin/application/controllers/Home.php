<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('auth');
		$user = $this->session->userdata('user');
		if($this->auth->re_auth() !== true && $this->uri->segment(1) !== 'login'){
			redirect(base_url('login'));
		}
	}

	public function index()
	{

		$page['title'] = 'Dashboard';
		$this->load->view('header',$page);
		$this->load->view('dashboard');
		
	}	
}
