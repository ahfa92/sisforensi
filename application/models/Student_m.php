<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class student_m extends CI_Model {


	protected $table = 'student';
	protected $primary_key = 'student_id';

	public function list($cond = null)
	{
		$this->db
			->join("village v","v.village_id = ".$this->table.".student_geo_address","left")
			->join("subdistrict s","s.subdistrict_id = v.subdistrict_id","left")
			->join("district d","d.district_id = s.district_id","left")
			->join("province p","p.province_id = d.province_id","left")
			->where($this->table.'.deleted_at is null');
		if($cond === null){
			return $this->db->get($this->table);
		} else {
			return $this->db->get_where($this->table,$cond);
		}
	}

	public function list_view($cond = null)
	{
		$view_table = 'view_student';
		$this->db->where($view_table.'.deleted_at is null');
		if($cond === null){
			return $this->db->get($view_table);
		} else {
			return $this->db->get_where($view_table,$cond);
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
		$query = $this->db
			->join("village v","v.village_id = ".$this->table.".student_geo_address","left")
			->join("subdistrict s","s.subdistrict_id = v.subdistrict_id","left")
			->join("district d","d.district_id = s.district_id","left")
			->join("province p","p.province_id = d.province_id","left")
			->get_where($this->table,$cond);
			
		return $query;
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