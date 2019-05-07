<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Holiday extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('admin/logout'));
		}
		$this->load->model('holiday_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->holiday_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$holidays = $this->holiday_m->list();
				$this->load->view('admin/holiday_v',array('page' => $page,'holidays' => $holidays));
			}
		} else if($this->input->post('action') == 'new'){
			$holiday = new stdClass();
			$page['title'] = 'Edit Holiday';

			$this->load->view('admin/holiday_form_v',array('page' => $page,'holiday' => $holiday));
		} else if($this->input->post('action') == 'create'){
			if($this->holiday_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$holidays = $this->holiday_m->list();
				$this->load->view('admin/holiday_v',array('page' => $page,'holidays' => $holidays));
			}
		} else if($this->input->post('action') == 'edit'){
			$holiday = $this->holiday_m->detail();
			if($holiday->num_rows() == 1){
				$page['title'] = 'Edit Holiday';

				$this->load->view('admin/holiday_form_v',array('page' => $page,'holiday' => $holiday->row()));
			} else {
				$page['message'] = "No data found";
				$holidays = $this->holiday_m->list();
				$this->load->view('admin/holiday_v',array('page' => $page,'holidays' => $holidays));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->holiday_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$holidays = $this->holiday_m->list();
				$this->load->view('admin/holiday_v',array('page' => $page,'holidays' => $holidays));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List Holiday';
			$holidays = $this->holiday_m->list();
			$this->load->view('admin/holiday_v',array('page' => $page,'holidays' => $holidays));
		}

		
	}

}
