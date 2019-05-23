<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('gender'))
{
	function gender($gender_id = 0)
	{
		$gender = ($gender_id == 1) ? "Laki-laki" : ($gender_id == 2 ? "Perempuan" : "Unknown");
		return $gender;
	}
}

if (!function_exists('dayname'))
{
	function dayname($param = 0)
	{
		$dayname = array(
			"1" => "Senin",
			"2" => "Selasa",
			"3" => "Rabu",
			"4" => "Kamis",
			"5" => "Jum'at",
			"6" => "Sabtu",
			"7" => "Ahad"
		);
		if(isset($dayname[$param])){
			return $dayname[$param];
		} else {
			return "Undefined";
		}
	}
}

if (!function_exists('periodtype'))
{
	function periodtype($param = 0)
	{
		$periodtype = array(
			"1" => "Semester",
			"2" => "Catur Wulan"
		);
		if($param == 'all'){
			return $periodtype;
		} else {
			if(isset($periodtype[$param])){
				return $periodtype[$param];
			} else {
				return "Undefined";
			}
		}
	}
}

if (!function_exists('periodcode'))
{
	function periodcode($param = 0)
	{
		$periodcode = array(
			"1" => "S",
			"2" => "C"
		);
		if($param == 'all'){
			return $periodcode;
		} else {
			if(isset($periodcode[$param])){
				return $periodcode[$param];
			} else {
				return "Undefined";
			}
		}
	}
}