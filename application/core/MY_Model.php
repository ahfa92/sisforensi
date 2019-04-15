<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $table;

	function __construct($tablename)
	{
		$this->table = $tablename;
		parent::__construct();
	}

	public function get()
	{
		return $this->db->get($this->table);
	}

	public function first()
	{
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function select($fields)
	{
		return $this->db->get($fields);
	}

	public function where($param1,$param2,$param3)
	{
		if(is_array($param1)){

			return $this->db->where($param1);

		} else if(func_num_args() == 3){
			
			$field = $param1.' '.$param2;
			$value = $param3;
			return $this->db->where($field,$value);

		} else {
			
			$field = $param1;
			$value = $param2;
			return $this->db->where($field,$value);

		}
		return false;
	}

	public function limit($limit,$offset = 0)
	{
		return $this->db->limit($limit,$offset);
	}


}