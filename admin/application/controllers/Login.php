<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run() !== false){
			$page['error'] = $this->login();
		}

		$page['title'] = 'Login';
		$this->load->view('login_v',array('page' => $page));

	}

	public function login()
	{

		if($this->auth->admin_authenticate()){
			redirect(site_url('/'));
		} else {
			return 'Wrong Username / Password!';	
		}

	}

	public function logout()
	{
		$this->session->unset_userdata('admin');
		redirect(site_url('login'));
	}
}
