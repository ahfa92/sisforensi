<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class schedule_m extends CI_Model {


	protected $table = 'course_schedule';
	protected $primary_key = 'schedule_id';

	public function list($cond = null)
	{
		if($cond !== null){
			foreach ($cond as $f => $v) {
				if(!empty($v) && $f !== 'action')
				$this->db->where($f,$v);
			}
		}

		return $this->db
			->join("class c","c.class_id = ".$this->table.".class_id","left")
			->join("lesson l","l.lesson_id = ".$this->table.".lesson_id","left")
			->join("educational_period ep","ep.edu_period_id = ".$this->table.".edu_period_id","left")
			->join("educational_year e","e.edu_year_id = ep.edu_year_id","left")
			->join("teacher t","t.teacher_id = ".$this->table.".teacher_id","left")
			->join("period p","p.period_id = ".$this->table.".period_id","left")
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
		$query = $this->db
			->join("course c","c.course_id = ".$this->table.".course_id","left")
			->join("educational_year e","e.edu_year_id = c.edu_year_id","left")
			->join("period p","p.period_id = ".$this->table.".period_id","left")
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