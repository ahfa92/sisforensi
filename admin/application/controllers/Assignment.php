<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('assignment_m');
		$this->load->model('class_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->assignment_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$this->default_view($page);
			}
		} else if($this->input->post('action') == 'new'){
			$assignment = new stdClass();
			$page['title'] = 'Edit Kelas';
			$this->load->view('assignment_form_v',array('page' => $page,'assignment' => $assignment));
		} else if($this->input->post('action') == 'create'){
			if($this->assignment_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$this->default_view($page);
			}
		} else if($this->input->post('action') == 'edit'){
			$assignment = $this->assignment_m->detail();
			if($assignment->num_rows() == 1){
				$page['title'] = 'Edit Kelas';
				$this->load->view('assignment_form_v',array('page' => $page,'assignment' => $assignment->row()));
			} else {
				$page['message'] = "No data found";
				$this->default_view($page);
			}
		} else if($this->input->post('action') == 'update'){
			if($this->assignment_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$this->default_view($page);
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List Kelas';
			$this->default_view($page);	
		}

	}

	public function default_view($page)
	{
		$edu_years = $this->eduyear_m->list();
		$classes = $this->class_m->list();
		if($this->input->get('edu_year_code') !== null){
			$cond['edu_year_code'] = $this->input->get('edu_year_code');
			$default_year = $this->eduyear_m->list($cond)->row();
		} else {
			$default_year = $this->db
					->join('educational_period ep','ep.edu_year_id = ey.edu_year_id',"left")
					->where('edu_period_start <=',date('Y-m-d'))
					->where('edu_period_end >=',date('Y-m-d'))
					->get('educational_year ey')
					->row();
			// var_dump($default_year);
		}
		
		foreach($classes->result() as $class){
			$cond['class_assignment.class_id'] = $class->class_id;
			$assignment = $this->assignment_m->summary_by_class($cond);
			if($assignment->num_rows()){
				$class->assignment = $assignment->row(); 
			} else { 
				$class->assignment = false; 
			}
		}
		$this->load->view('assignment_v',array('page' => $page,'classes' => $classes, 'edu_years' => $edu_years, 'default_year' => $default_year));
	}

}
