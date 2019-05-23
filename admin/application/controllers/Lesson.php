<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('lesson_m');
		$this->load->model('lessoncat_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->lesson_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$lessons = $this->lesson_m->list();
				$this->load->view('lesson_v',array('page' => $page,'lessons' => $lessons));
			}
		} else if($this->input->post('action') == 'new'){
			$lesson = new stdClass();
			$page['title'] = 'Edit Kelas';
			$cats = $this->lessoncat_m->list();

			$this->load->view('lesson_form_v',array('page' => $page,'lesson' => $lesson, 'cats' => $cats ));
		} else if($this->input->post('action') == 'create'){
			if($this->lesson_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$lessons = $this->lesson_m->list();
				$this->load->view('lesson_v',array('page' => $page,'lessons' => $lessons));
			}
		} else if($this->input->post('action') == 'edit'){
			$lesson = $this->lesson_m->detail();
			if($lesson->num_rows() == 1){
				$page['title'] = 'Edit Kelas';
				$cats = $this->lessoncat_m->list();

				$this->load->view('lesson_form_v',array('page' => $page,'lesson' => $lesson->row(), 'cats' => $cats));
			} else {
				$page['message'] = "No data found";
				$lessons = $this->lesson_m->list();
				$this->load->view('lesson_v',array('page' => $page,'lessons' => $lessons));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->lesson_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$lessons = $this->lesson_m->list();
				$this->load->view('lesson_v',array('page' => $page,'lessons' => $lessons));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List Kelas';
			$lessons = $this->lesson_m->list();
			$this->load->view('lesson_v',array('page' => $page,'lessons' => $lessons));
		}

		
	}

}
