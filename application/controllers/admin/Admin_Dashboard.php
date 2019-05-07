<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('admin/login'));
		}
	}

	public function index()
	{
		$page['title'] = 'Dashboard';
		$this->load->view('admin/dashboard_v',array('page' => $page));

	}

}
