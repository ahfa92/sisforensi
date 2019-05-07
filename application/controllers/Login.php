<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		if(!empty($this->input->post())){
			$this->login();
		} else {
			$page['title'] = 'Login';
			$this->load->view('login_v',array('page' => $page));
		}

	}

	public function login()
	{

		

	}
}
