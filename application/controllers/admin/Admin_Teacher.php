<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Teacher extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('admin/logout'));
		}
		$this->load->model('teacher_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->teacher_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$teachers = $this->teacher_m->list();
				$this->load->view('admin/teacher_v',array('page' => $page,'teachers' => $teachers));
			}
		} else if($this->input->post('action') == 'new'){
			$teacher = new stdClass();
			$page['title'] = 'Edit teacher';
			$provs = $this->db->get('province');
			$dists = $this->db->get('district');
			$sdists = $this->db->get('subdistrict');
			$vlgs = $this->db->get('village');

			$this->load->view('admin/teacher_form_v',array('page' => $page,'teacher' => $teacher, 'provs' => $provs, 'dists' => $dists, 'sdists' => $sdists, 'vlgs' => $vlgs));
		} else if($this->input->post('action') == 'create'){
			if($this->teacher_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$teachers = $this->teacher_m->list();
				$this->load->view('admin/teacher_v',array('page' => $page,'teachers' => $teachers));
			}
		} else if($this->input->post('action') == 'edit'){
			$teacher = $this->teacher_m->detail();
			if($teacher->num_rows() == 1){
				$page['title'] = 'Edit teacher';
				$provs = $this->db->get('province');
				$dists = $this->db->get('district');
				$sdists = $this->db->get('subdistrict');
				$vlgs = $this->db->get('village');

				$this->load->view('admin/teacher_form_v',array('page' => $page,'teacher' => $teacher->row(), 'provs' => $provs, 'dists' => $dists, 'sdists' => $sdists, 'vlgs' => $vlgs));
			} else {
				$page['message'] = "No data found";
				$teachers = $this->teacher_m->list();
				$this->load->view('admin/teacher_v',array('page' => $page,'teachers' => $teachers));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->teacher_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$teachers = $this->teacher_m->list();
				$this->load->view('admin/teacher_v',array('page' => $page,'teachers' => $teachers));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List teacher';
			$teachers = $this->teacher_m->list();
			$this->load->view('admin/teacher_v',array('page' => $page,'teachers' => $teachers));
		}

		
	}

}
