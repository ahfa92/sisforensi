<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class period_m extends CI_Model {


	protected $table = 'period';
	protected $primary_key = 'period_id';

	public function list($cond = null)
	{
		$this->db->where($this->table.'.deleted_at is null');
		if($cond === null){
			return $this->db->get($this->table);
		} else {
			return $this->db->get_where($this->table,$cond);
		}
	}

	public function list_by_time($cond = null)
	{
		$this->db
			->where($this->table.'.deleted_at is null')
			->order_by('period_start_time');
		if($cond === null){
			return $this->db->get($this->table);
		} else {
			return $this->db->get_where($this->table,$cond);
		}
	}

	public function create()
	{
		$post = $this->input->post();
		$fields = $this->db->list_fields($this->table);
		$input = array();

		foreach ($fields as $v) {
			if(isset($post[$v])) {
				$input[$v] = $post[$v];
			}
		}

		$input['created_at'] = date('Y-m-d H:i:s');

		if($this->db->insert($this->table,$input)){
			return true;
		} else {
			return false;
		}
	}

	public function detail()
	{
		$cond[$this->primary_key] = $this->input->post($this->primary_key);
		return $this->db->get_where($this->table,$cond);
	}

	public function update()
	{
		$post = $this->input->post();
		$fields = $this->db->list_fields($this->table);
		$input = array();

		foreach ($fields as $v) {
			if(isset($post[$v])) {
				$input[$v] = $post[$v];
			}
		}

		$input['updated_at'] = date('Y-m-d H:i:s');

		$cond[$this->primary_key] = $this->input->post($this->primary_key);		
		if($this->db->update($this->table,$input,$cond)){
			return true;
		} else {
			return false;
		}
	}

	public function delete()
	{
		$cond[$this->primary_key] = $this->input->post($this->primary_key);
		$input['deleted_at'] = date('Y-m-d H:i:s');
		if($this->db->update($this->table,$input,$cond)){
			return true;
		} else {
			return false;
		}
	}


}