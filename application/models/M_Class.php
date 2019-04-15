<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Class extends MY_Model {

	protected $table = "classes";

	function __construct()
	{
		parent::__construct($this->table);
	}

}