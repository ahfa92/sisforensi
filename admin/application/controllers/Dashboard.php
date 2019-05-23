<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('login'));
		}
	}

	public function index()
	{
		$page['title'] = 'Dashboard';
		$this->load->view('dashboard_v',array('page' => $page));

	}

}
