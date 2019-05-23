<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
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
				$this->load->view('teacher_v',array('page' => $page,'teachers' => $teachers));
			}
		} else if($this->input->post('action') == 'new'){
			$teacher = new stdClass();
			$page['title'] = 'Edit teacher';
			$birthplaces = $this->db->get('district');
			$provs = $this->db->get('province');
			$dists = $this->db->get('district');
			$sdists[] = new stdClass();
			$vlgs[] = new stdClass();

			$this->load->view('teacher_form_v',array('page' => $page,'teacher' => $teacher,'birthplaces' => $birthplaces , 'provs' => $provs, 'dists' => $dists, 'sdists' => $sdists, 'vlgs' => $vlgs));
		} else if($this->input->post('action') == 'create'){
			if($this->teacher_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$teachers = $this->teacher_m->list();
				$this->load->view('teacher_v',array('page' => $page,'teachers' => $teachers));
			}
		} else if($this->input->post('action') == 'edit'){
			$teacher = $this->teacher_m->detail();
			if($teacher->num_rows() == 1){
				$page['title'] = 'Edit teacher';
				$provs = $this->db->get('province');
				$birthplaces = $this->db
					->get('district');
				$dists = $this->db
					->where('province_id',$teacher->row()->province_id)
					->get('district');
				$sdists = $this->db
					->where('district_id',$teacher->row()->district_id)
					->get('subdistrict');
				$vlgs = $this->db
					->where('subdistrict_id',$teacher->row()->subdistrict_id)
					->get('village');

				$this->load->view('teacher_form_v',array('page' => $page,'teacher' => $teacher->row(), 'birthplaces' => $birthplaces, 'provs' => $provs, 'dists' => $dists, 'sdists' => $sdists, 'vlgs' => $vlgs));
			} else {
				$page['message'] = "No data found";
				$teachers = $this->teacher_m->list();
				$this->load->view('teacher_v',array('page' => $page,'teachers' => $teachers));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->teacher_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$teachers = $this->teacher_m->list();
				$this->load->view('teacher_v',array('page' => $page,'teachers' => $teachers));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List teacher';
			$teachers = $this->teacher_m->list();
			$this->load->view('teacher_v',array('page' => $page,'teachers' => $teachers));
		}

		
	}

}
