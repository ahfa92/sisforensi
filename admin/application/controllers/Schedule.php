<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('schedule_m');
		$this->load->model('course_m');
		$this->load->model('class_m');
		$this->load->model('lesson_m');
		$this->load->model('period_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->schedule_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$this->default_view($page);
			}
		} else if($this->input->post('action') == 'create'){
			if($this->schedule_m->create()){
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$this->default_view($page);
			}
		} else if($this->input->post('action') == 'update'){
			if($this->schedule_m->update()){
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$this->default_view($page);
			}
		} else {
			$this->default_view();
		}
	}

	public function default_view($page = null)
	{
		if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List schedule';
			$edu_years = $this->eduyear_m->list();

			if(isset($_GET['edu_year_code'])){
				$input['edu_year_code'] = $this->input->get('edu_year_code'); 
			} else {
				$date = date('Y-m-d');
				$current_period = $this->eduperiod_m->date_period($date);
				if($current_period->num_rows > 0){
					$input['edu_year_code'] = $current_period->row()->edu_year_code; 
				} else {
					$input['edu_year_code'] = '';
				}
			}
			$edu_periods = $this->eduperiod_m->list($input);

			$classes = $this->class_m->list();
			$periods = $this->period_m->list_by_time();

			$input = null;
			foreach($this->input->get() as $f => $v){
				if($f !== 'period_id' && $f !== 'day'){
					$input[$f] = $v;
				} 
			}

			$courses = $this->course_m->list($input);
			$days = array(1,2,3,4,5,6);
			$schedules = array();
			foreach($days as $i) { 
				$input['day'] = $i;
				foreach ($periods->result() as $k => $period) {
					$input['period_start_time'] = $period->period_start_time;
					$schedules[$k+1]['detail'] = $period;

					$schedule = $this->schedule_m->list($input);
					if($schedule->num_rows() > 0){
						$schedules[$k+1][$i] = $schedule->row();
					} else {
						$schedules[$k+1][$i] = false;
					}
				}
			}

			$this->load->view('schedule_v',array('page' => $page,'edu_years' => $edu_years,'edu_periods' => $edu_periods,'classes' => $classes, 'days' => $days, 'courses' => $courses, 'schedules' => $schedules));
	}

}
