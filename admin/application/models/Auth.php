<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Model {

	public function admin_authenticate()
	{
		
		$condition = array(
			'admin_username' => $this->input->post('username')
		);

		$query = $this->db->get_where('admin',$condition);

		if($query->num_rows() == 1){
			$admin = $query->row();
			if(password_verify($this->input->post('password'), $admin->admin_password)){
				$token = md5('admin'.$admin->admin_id.date('Y-m-d h:i:s'));

				$admin_token['admin_token'] = $token;
				$this->db->where('admin_id',$admin->admin_id)->update('admin',$admin_token);
				$edu_year = $this->db
					->join('educational_period ep','ep.edu_year_id = ey.edu_year_id',"left")
					->where('edu_period_start <=',date('Y-m-d'))
					->where('edu_period_end >=',date('Y-m-d'))
					->get('educational_year ey')
					->row();
				$this->session->set_userdata('admin',$admin);
				$this->session->set_userdata('edu_year',$edu_year);
				$this->session->set_userdata('admin_token',$token);
				return true;
			} 
		}
		
		return false;

	}

	public function admin_re_auth()
	{
		$token = $this->session->userdata('admin_token');

		if(!empty($token)){

			$condition = array('admin_token' => $token);

			$query = $this->db->get_where('admin',$condition);

			if($query->num_rows() == 1){
				return true;
			} 
		} 
		
		return false;
	}

	public function authenticate()
	{
		
		$condition = array(
			'nip' => $this->input->post('username')
		);

		$query = $this->db->get_where('teacher',$condition);

		if($query->num_rows() == 1){
			$user = $query->row();
			if(password_verify($this->input->post('password'), $user->teacher_password)){
				$token = md5($user->teacher_id.date('Y-m-d h:i:s'));

				$teacher_token['teacher_token'] = $token;
				$this->db->where('teacher_id',$user->teacher_id)->update('teacher',$teacher_token);
				$this->session->set_userdata('user',$user);
				$this->session->set_userdata('token',$token);
				return true;
			} 
		}
		
		return false;

	}

	public function re_auth()
	{
		$token = $this->session->userdata('token');

		if(!empty($token)){

			$condition = array('teacher_token' => $token);

			$query = $this->db->get_where('teacher',$condition);

			if($query->num_rows() == 1){
				return true;
			} 
		} 
		
		return false;
	}

}