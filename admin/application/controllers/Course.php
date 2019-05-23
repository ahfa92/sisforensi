<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('assignment_m');
		$this->load->model('course_m');
		$this->load->model('class_m');
		$this->load->model('lesson_m');
		$this->load->model('teacher_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->course_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$courses = $this->course_m->list();
				$this->load->view('course_v',array('page' => $page,'courses' => $courses));
			}
		} else if($this->input->post('action') == 'new'){
			$course = new stdClass();
			$page['title'] = 'New course';
			$edu_periods = $this->eduperiod_m->list();
			$classes = $this->class_m->list();
			$lessons = $this->lesson_m->list();
			$teachers = $this->teacher_m->list();

			$this->load->view('course_form_v',array('page' => $page,'course' => $course, 'edu_periods' => $edu_periods, 'classes' => $classes, 'teachers' => $teachers, 'lessons' => $lessons));
		} else if($this->input->post('action') == 'create'){
			if($this->course_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$courses = $this->course_m->list();
				$this->load->view('course_v',array('page' => $page,'courses' => $courses));
			}
		} else if($this->input->post('action') == 'edit'){
			$course = $this->course_m->detail();
			if($course->num_rows() == 1){
				$page['title'] = 'Edit course';
				$edu_years = $this->eduyear_m->list();
				$classes = $this->class_m->list();
				$lessons = $this->lesson_m->list();
				$teachers = $this->teacher_m->list();

				$this->load->view('course_form_v',array('page' => $page,'course' => $course->row(), 'edu_years' => $edu_years, 'classes' => $classes, 'teachers' => $teachers, 'lessons' => $lessons));
			} else {
				$page['message'] = "No data found";
				$courses = $this->course_m->list();
				$this->load->view('course_v',array('page' => $page,'courses' => $courses));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->course_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$courses = $this->course_m->list();
				$this->load->view('course_v',array('page' => $page,'courses' => $courses));
			}
		} else {
			$this->default_view();
		}

		
	}

	public function default_view()
	{
		if(!empty($this->session->flashdata('message'))){
			$page['message'] = $this->session->flashdata('message');
		}
		$page['title'] = 'List course';
		$input = $this->input->get();

		$edu_years = $this->eduyear_m->list();
		
		$cnd = null;
		if(isset($input['edu_year_code'])){
			$cnd['edu_year_code'] = $input['edu_year_code'];
		}
		$edu_periods = $this->eduperiod_m->list($cnd);
		
		$classes = $this->class_m->list();
		$lessons = $this->lesson_m->list();
		$teachers = $this->teacher_m->list();
		
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

		if(!empty($input)){
			$courses = $this->course_m->list($input);
		} else {
			$courses = $this->course_m->list();
		}
		$this->load->view('course_v',array('page' => $page,'courses' => $courses,'edu_years' => $edu_years, 'edu_periods' => $edu_periods, 'default_year' => $default_year, 'classes' => $classes, 'lessons' => $lessons, 'teachers' => $teachers));
	}

}
