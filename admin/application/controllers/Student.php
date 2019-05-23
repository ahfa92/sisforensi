<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('student_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->student_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$students = $this->student_m->list();
				$this->load->view('student_v',array('page' => $page,'students' => $students));
			}
		} else if($this->input->post('action') == 'new'){
			$student = new stdClass();
			$page['title'] = 'Edit student';
			$birthplaces = $this->db->get('district');
			$provs = $this->db->get('province');
			$dists = $this->db->get('district');
			$sdists[] = new stdClass();
			$vlgs[] = new stdClass();

			$this->load->view('student_form_v',array('page' => $page,'student' => $student,'birthplaces' => $birthplaces , 'provs' => $provs, 'dists' => $dists, 'sdists' => $sdists, 'vlgs' => $vlgs));
		} else if($this->input->post('action') == 'create'){
			if($this->student_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$students = $this->student_m->list();
				$this->load->view('student_v',array('page' => $page,'students' => $students));
			}
		} else if($this->input->post('action') == 'edit'){
			$student = $this->student_m->detail();
			if($student->num_rows() == 1){
				$page['title'] = 'Edit student';
				$provs = $this->db->get('province');
				$birthplaces = $this->db
					->get('district');
				$dists = $this->db
					->where('province_id',$student->row()->province_id)
					->get('district');
				$sdists = $this->db
					->where('district_id',$student->row()->district_id)
					->get('subdistrict');
				$vlgs = $this->db
					->where('subdistrict_id',$student->row()->subdistrict_id)
					->get('village');

				$this->load->view('student_form_v',array('page' => $page,'student' => $student->row(), 'birthplaces' => $birthplaces, 'provs' => $provs, 'dists' => $dists, 'sdists' => $sdists, 'vlgs' => $vlgs));
			} else {
				$page['message'] = "No data found";
				$students = $this->student_m->list();
				$this->load->view('student_v',array('page' => $page,'students' => $students));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->student_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$students = $this->student_m->list();
				$this->load->view('student_v',array('page' => $page,'students' => $students));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List student';
			$students = $this->student_m->list_view();
			$this->load->view('student_v',array('page' => $page,'students' => $students));
		}

		
	}

}
