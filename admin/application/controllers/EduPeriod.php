<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EduPeriod extends CI_Controller {

	function __construct(){
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($this->auth->admin_re_auth() !== true){
			redirect(site_url('logout'));
		}
		$this->load->model('eduperiod_m');
	}

	public function index()
	{
		if($this->input->post('action') == 'delete'){
			if($this->eduperiod_m->delete()){
				$this->session->set_flashdata('message',"Delete success");
				redirect(current_url());		
			} else {
				$page['message'] = "Delete failed";
				$eduperiods = $this->eduperiod_m->list();
				$this->load->view('eduperiod_v',array('page' => $page,'eduperiods' => $eduperiods));
			}
		} else if($this->input->post('action') == 'new'){
			$eduperiod = new stdClass();
			$page['title'] = 'Edit eduperiod';
			$edu_years = $this->eduyear_m->list();

			$this->load->view('eduperiod_form_v',array('page' => $page,'eduperiod' => $eduperiod, 'edu_years' => $edu_years));
		} else if($this->input->post('action') == 'create'){
			if($this->eduperiod_m->create()){
				$id = $this->db->insert_id();
				$this->updateCode($id);
				$this->session->set_flashdata('message',"Create success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$eduperiods = $this->eduperiod_m->list();
				$this->load->view('eduperiod_v',array('page' => $page,'eduperiods' => $eduperiods));
			}
		} else if($this->input->post('action') == 'edit'){
			$eduperiod = $this->eduperiod_m->detail();
			$edu_years = $this->eduyear_m->list();
			if($eduperiod->num_rows() == 1){
				$page['title'] = 'Edit eduperiod';

				$this->load->view('eduperiod_form_v',array('page' => $page,'eduperiod' => $eduperiod->row(), 'edu_years' => $edu_years));
			} else {
				$page['message'] = "No data found";
				$eduperiods = $this->eduperiod_m->list();
				$this->load->view('eduperiod_v',array('page' => $page,'eduperiods' => $eduperiods));
			}
		} else if($this->input->post('action') == 'update'){
			if($this->eduperiod_m->update()){
				$id = $this->input->post('edu_period_id');
				$this->updateCode($id);
				$this->session->set_flashdata('message',"Update success");
				redirect(current_url());		
			} else {
				$page['message'] = "Create failed";
				$eduperiods = $this->eduperiod_m->list();
				$this->load->view('eduperiod_v',array('page' => $page,'eduperiods' => $eduperiods));
			}
		} else {
			if(!empty($this->session->flashdata('message'))){
				$page['message'] = $this->session->flashdata('message');
			}
			$page['title'] = 'List eduperiod';
			$eduperiods = $this->eduperiod_m->list();
			$this->load->view('eduperiod_v',array('page' => $page,'eduperiods' => $eduperiods));
		}

		
	}

	public function updateCode($edu_period_id)
	{
		$edu_year_id = $this->input->post('edu_year_id');
		$period_type = $this->input->post('edu_period_type');
		$period_num = $this->input->post('edu_period_num');

		$edu_period_code = $this->db
			->select("concat(edu_year_code,'-','".periodcode($period_type)."','".$period_num."') edu_period_code")
			->where('edu_year_id',$edu_year_id)
			->where('deleted_at is null')
			->get('educational_year')
			->row()->edu_period_code;

		$this->db->where('edu_period_id',$edu_period_id)->set('edu_period_code',$edu_period_code)->update('educational_period');

	}

}
