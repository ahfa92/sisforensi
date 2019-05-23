<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class assignment_m extends CI_Model {


	protected $table = 'class_assignment';
	protected $primary_key = 'class_assignment_id';

	public function list($cond = null)
	{
		$this->db
			->join('class','class.class_id = '.$this->table.'.class_id','right')
			->join('student','student.student_id = '.$this->table.'.student_id','left')
			->where($this->table.'.deleted_at is null');
		if($cond === null){
			return $this->db->get($this->table);
		} else {
			return $this->db->get_where($this->table,$cond);
		}
	}

	public function summary_by_class($cond = null)
	{
		if(isset($cond) && $cond !== null){
			foreach($cond as $f => $v)
			$this->db->where($f,$v);
		}
		return $this->db
			->select("class.*,educational_year.*, class_assignment_id, count(student_id) as students")
			->join("class",'class.class_id = '.$this->table.'.class_id ','right')
			->join('educational_year','educational_year.edu_year_id = '.$this->table.'.edu_year_id','left')
			->group_by("class.class_id")
			->where($this->table.'.deleted_at is null')
			->get($this->table);
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