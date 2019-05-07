<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Class extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('admin/logout'));
		}
		$this->load->model('class_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->class_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$classes = $this->class_m->list();
				$this->load->view('admin/class_v',array('page' => $page,'classes' => $classes));
			}
		} else if($this->input->post('action') == 'new'){
			$class = new stdClass();
			$page['title'] = 'Edit Kelas';
			$this->load->view('admin/class_form_v',array('page' => $page,'class' => $class));
		} else if($this->input->post('action') == 'create'){
			if($this->class_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$classes = $this->class_m->list();
				$this->load->view('admin/class_v',array('page' => $page,'classes' => $classes));
			}
		} else if($this->input->post('action') == 'edit'){
			$class = $this->class_m->detail();
			if($class->num_rows() == 1){
				$page['title'] = 'Edit Kelas';
				$this->load->view('admin/class_form_v',array('page' => $page,'class' => $class->row()));
			} else {
				$page['message'] = "No data found";
				$classes = $this->class_m->list();
				$this->load->view('admin/class_v',array('page' => $page,'classes' => $classes));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->class_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$classes = $this->class_m->list();
				$this->load->view('admin/class_v',array('page' => $page,'classes' => $classes));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List Kelas';
			$classes = $this->class_m->list();
			$this->load->view('admin/class_v',array('page' => $page,'classes' => $classes));
		}

		
	}

}
