<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Period extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('period_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->period_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$periods = $this->period_m->list();
				$this->load->view('period_v',array('page' => $page,'periods' => $periods));
			}
		} else if($this->input->post('action') == 'new'){
			$period = new stdClass();
			$page['title'] = 'Edit period';

			$this->load->view('period_form_v',array('page' => $page,'period' => $period));
		} else if($this->input->post('action') == 'create'){
			if($this->period_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$periods = $this->period_m->list();
				$this->load->view('period_v',array('page' => $page,'periods' => $periods));
			}
		} else if($this->input->post('action') == 'edit'){
			$period = $this->period_m->detail();
			if($period->num_rows() == 1){
				$page['title'] = 'Edit period';

				$this->load->view('period_form_v',array('page' => $page,'period' => $period->row()));
			} else {
				$page['message'] = "No data found";
				$periods = $this->period_m->list();
				$this->load->view('period_v',array('page' => $page,'periods' => $periods));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->period_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$periods = $this->period_m->list();
				$this->load->view('period_v',array('page' => $page,'periods' => $periods));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List period';
			$periods = $this->period_m->list();
			$this->load->view('period_v',array('page' => $page,'periods' => $periods));
		}

		
	}

}
