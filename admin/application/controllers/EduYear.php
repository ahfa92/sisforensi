<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EduYear extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('eduyear_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->eduyear_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$eduyears = $this->eduyear_m->list();
				$this->load->view('eduyear_v',array('page' => $page,'eduyears' => $eduyears));
			}
		} else if($this->input->post('action') == 'new'){
			$eduyear = new stdClass();
			$page['title'] = 'Edit eduyear';

			$this->load->view('eduyear_form_v',array('page' => $page,'eduyear' => $eduyear));
		} else if($this->input->post('action') == 'create'){
			if($this->eduyear_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$eduyears = $this->eduyear_m->list();
				$this->load->view('eduyear_v',array('page' => $page,'eduyears' => $eduyears));
			}
		} else if($this->input->post('action') == 'edit'){
			$eduyear = $this->eduyear_m->detail();
			if($eduyear->num_rows() == 1){
				$page['title'] = 'Edit eduyear';

				$this->load->view('eduyear_form_v',array('page' => $page,'eduyear' => $eduyear->row()));
			} else {
				$page['message'] = "No data found";
				$eduyears = $this->eduyear_m->list();
				$this->load->view('eduyear_v',array('page' => $page,'eduyears' => $eduyears));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->eduyear_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$eduyears = $this->eduyear_m->list();
				$this->load->view('eduyear_v',array('page' => $page,'eduyears' => $eduyears));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List eduyear';
			$eduyears = $this->eduyear_m->list();
			$this->load->view('eduyear_v',array('page' => $page,'eduyears' => $eduyears));
		}

		
	}

}
