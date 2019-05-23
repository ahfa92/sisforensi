<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LessonCat extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('lessoncat_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->lessoncat_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$lessoncats = $this->lessoncat_m->list();
				$this->load->view('lessoncat_v',array('page' => $page,'lessoncats' => $lessoncats));
			}
		} else if($this->input->post('action') == 'new'){
			$lessoncat = new stdClass();
			$page['title'] = 'Edit Kelas';
			$this->load->view('lessoncat_form_v',array('page' => $page,'lessoncat' => $lessoncat));
		} else if($this->input->post('action') == 'create'){
			if($this->lessoncat_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$lessoncats = $this->lessoncat_m->list();
				$this->load->view('lessoncat_v',array('page' => $page,'lessoncats' => $lessoncats));
			}
		} else if($this->input->post('action') == 'edit'){
			$lessoncat = $this->lessoncat_m->detail();
			if($lessoncat->num_rows() == 1){
				$page['title'] = 'Edit Kelas';
				$this->load->view('lessoncat_form_v',array('page' => $page,'lessoncat' => $lessoncat->row()));
			} else {
				$page['message'] = "No data found";
				$lessoncats = $this->lessoncat_m->list();
				$this->load->view('lessoncat_v',array('page' => $page,'lessoncats' => $lessoncats));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->lessoncat_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$lessoncats = $this->lessoncat_m->list();
				$this->load->view('lessoncat_v',array('page' => $page,'lessoncats' => $lessoncats));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List Kelas';
			$lessoncats = $this->lessoncat_m->list();
			$this->load->view('lessoncat_v',array('page' => $page,'lessoncats' => $lessoncats));
		}

		
	}

}
