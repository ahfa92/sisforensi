<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{}

	public function districts()
	{
		$province_id = $this->input->get('province_id');

		if(!empty($province_id)){
			$this->db->where('province_id',$province_id);
		}

		$dists = $this->db->get('district');
		$html = "";
		$options = array();
		if($dists->num_rows() > 0){
			$options = $dists->result();
			foreach($options as $dist) {
				$html .= "<option value='".$dist->district_id."'>".$dist->district_name."</option>\n";
			}
		}

		echo json_encode(array('html' => $html, 'options' => $options));
	}

	public function subdistricts()
	{
		$district_id = $this->input->get('district_id');

		if(!empty($district_id)){
			$this->db->where('district_id',$district_id);
		}

		$subdists = $this->db->get('subdistrict');
		$html = "";
		$options = array();
		if($subdists->num_rows() > 0){
			$options = $subdists->result();
			foreach($options as $subdist) {
				$html .= "<option value='".$subdist->subdistrict_id."'>".$subdist->subdistrict_name."</option>\n";
			}
		}

		echo json_encode(array('html' => $html, 'options' => $options));
	}

	public function villages()
	{
		$subdistrict_id = $this->input->get('subdistrict_id');

		if(!empty($subdistrict_id)){
			$this->db->where('subdistrict_id',$subdistrict_id);
		}

		$villages = $this->db->get('village');
		$html = "";
		$options = array();
		if($villages->num_rows() > 0){
			$options = $villages->result();
			foreach($options as $village) {
				$html .= "<option value='".$village->village_id."'>".$village->village_name."</option>\n";
			}
		}

		echo json_encode(array('html' => $html, 'options' => $options));
	}

	public function eduperiod()
	{
		$input = $this->input->get();

		if(!empty($input)){
			$this->db->where($input);
		}

		$periods = $this->db
			->join('educational_year ey','ey.edu_year_id = ep.edu_year_id')
			->get('educational_period ep');
		$html = "";
		$options = array();
		if($periods->num_rows() > 0){
			$options = $periods->result();
			foreach($options as $period) {
				$html .= "<option value='".$period->edu_period_code."'>".$period->edu_period_code."</option>\n";
			}
		}

		echo json_encode(array('html' => $html, 'options' => $options));
	}

	public function assignment()
	{
		$class_code = $this->input->get('class_code');
		$edu_year_code = $this->input->get('edu_year_code');
		$students_class = $this->db
			->select("student.*, class_assignment.class_assignment_id")
			->join("student","student.student_id = class_assignment.student_id")
			->join("educational_year","educational_year.edu_year_id = class_assignment.edu_year_id")
			->join("class","class.class_id = class_assignment.class_id")
			->where('class_code',$class_code)
			->where('edu_year_code',$edu_year_code)
			->where('class_assignment.deleted_at is null')
			->get("class_assignment");

		$students = array('');
		foreach ($students_class->result() as $std) {
			$students[] = $std->student_id;
		}

		$students_other = $this->db
			->select("student.*, class_assignment.class_assignment_id")
			->join("student","student.student_id = class_assignment.student_id")
			->join("educational_year","educational_year.edu_year_id = class_assignment.edu_year_id")
			->join("class","class.class_id = class_assignment.class_id")
			->where('edu_year_code',$edu_year_code)
			->where('class_assignment.deleted_at is null')
			->get("class_assignment");

		foreach ($students_other->result() as $std) {
			$students[] = $std->student_id;
		}
			
		$students_free = $this->db
			->where_not_in('student_id',$students)
			->where('student.deleted_at is null')
			->get("student");

		$title = 'List Siswa';

		$html = '
		<div class="col-12">
			<div class="form-group">
				<div class="col-sm-12">
					<select id="student_id" class="form-control" name="student_id" data-class="'.$class_code.'" data-year="'.$edu_year_code.'" multiple="multiple">
					';
						if($students_class->num_rows() > 0 || $students_free->num_rows() > 0) { 
							foreach($students_class->result() as $student) {  
								$student_name = trim($student->student_firstname.' '.$student->student_lastname);
								$html .= '<option value="'.$student->student_id.'" '.(isset($student->class_assignment_id) ? "selected" : "").'>'.$student_name.'</option>';
							}
							unset($student); 
							foreach($students_free->result() as $student) { 
								$student_name = trim($student->student_firstname.' '.$student->student_lastname);
								$html .= '<option value="'.$student->student_id.'" '.(isset($student->class_assignment_id) ? 'selected' : '').'>'.$student_name.'</option>';
							} 
						} else { 
							$html .= '<option value="">No Student Available</option>';
						}
		$html .= '</select>
				</div>
				<script type="text/javascript">
					$("#student_id").multiSelect({
						afterSelect: function(values){
							$.ajax({url:"'.site_url("api/assign_student").'",data:{class_code:this.$element.attr("data-class"),edu_year_code:this.$element.attr("data-year"),student_id:values},dataType:"json",method:"post"})
								.done(function(resp){
									$("#modal-body").prepend(resp.html);
								});
					  	},
					  	afterDeselect: function(values){
					  		$.ajax({url:"'.site_url("api/unassign_student").'",data:{class_code:this.$element.attr("data-class"),edu_year_code:this.$element.attr("data-year"),student_id:values},dataType:"json",method:"post"})
								.done(function(resp){
									$("#modal-body").prepend(resp.html);
								});
					  	}
		 			});
				</script>
			</div>
		</div>';
		echo json_encode(array('html' => $html, 'title' => $title));
	}

	public function assign_student()
	{
		$class_code = $this->input->post('class_code');
		$edu_year_code = $this->input->post('edu_year_code');
		$student_ids = $this->input->post('student_id');
		$html = '';

		$class_id = $this->db->where('class_code',$class_code)->get('class')->row()->class_id;
		$edu_year_id = $this->db->where('edu_year_code',$edu_year_code)->get('educational_year')->row()->edu_year_id;

		if($student_ids !== null){
			$input = array();
			foreach ($student_ids as $idx => $id) {
				$input[$idx]['class_id'] = $class_id;
				$input[$idx]['edu_year_id'] = $edu_year_id;
				$input[$idx]['student_id'] = $id;
			}

			if($this->db->insert_batch('class_assignment',$input)){
				$message = "Assignment success";
				$color = "alert-info";
			} else {
				$message = "Assignment failed";
				$color = "alert-danger";
			}
			$html .= '<div class="alert '.$color.' alert-dismissible fade show">'.$message.'</div>';
		}

		echo json_encode(array('html' => $html));
	}

	public function unassign_student()
	{
		$class_code = $this->input->post('class_code');
		$edu_year_code = $this->input->post('edu_year_code');
		$student_ids = $this->input->post('student_id');
		$html = '';

		$class_id = $this->db->where('class_code',$class_code)->get('class')->row()->class_id;
		$edu_year_id = $this->db->where('edu_year_code',$edu_year_code)->get('educational_year')->row()->edu_year_id;

		if($student_ids !== null){
			$cond = array();
			foreach ($student_ids as $idx => $id) {
				$cond['class_id'] = $class_id;
				$cond['edu_year_id'] = $edu_year_id;
				$cond['student_id'] = $id;

				// $set['deleted_at'] = date('Y-m-d H:i:s');

				if($this->db->where($cond)->delete('class_assignment')){
					$message = "Unassignment success";
					$color = "alert-info";
				} else {
					$message = "Unassignment failed";
					$color = "alert-danger";
				}
			$html .= '<div class="alert '.$color.' alert-dismissible fade show">'.$message.'</div>';
			}
		}

		echo json_encode(array('html' => $html));
	}

	public function updateschedule()
	{
		$param = $this->input->post();
		$input['day'] = isset($param['day']) ? $param['day'] : '';
		$input['period_id'] = isset($param['period_id']) ? $param['period_id'] : '';

		$this->load->model('schedule_m');
		$this->load->model('course_m');

		if(isset($param['course_id'])){
			$course_id['course_id'] = $param['course_id'];
		} else {
			$course_id['course_id'] = '';
		}
		$course = $this->db->get_where('course',$course_id);

		if($course->num_rows() > 0){
			$course = $course->row();
			$input['lesson_id'] = $course->lesson_id;
			$input['teacher_id'] = $course->teacher_id;
		} else {
			$input['lesson_id'] = '';
			$input['teacher_id'] = '';
		}

		$cnd['class_code'] = isset($param['class_code']) ? $param['class_code'] : '';
		$cnd['edu_period_code'] = isset($param['edu_period_code']) ? $param['edu_period_code'] : '';
		$cnd['day'] = isset($param['day']) ? $param['day'] : '';
		$cnd['period_id'] = isset($param['period_id']) ? $param['period_id'] : '';
		
		$schedule = $this->db
			->join('educational_period ep','ep.edu_period_id = cs.edu_period_id')
			->join('class c','c.class_id = cs.class_id')
			->get_where('course_schedule cs',$cnd);

		if($schedule->num_rows() > 0){
			$schedule = $schedule->row();
			$schedule_id['schedule_id'] = $schedule->schedule_id;
			if($this->db->update('course_schedule',$input,$schedule_id)){
				$status = true;
				$message = "OK";
			} else {
				$status = false;
				$message = $this->db->error();
			}
			$last_id = $schedule->schedule_id;
		} else {
			$input['edu_period_id'] = '';
			$input['class_id'] = '';
			
			if(isset($param['edu_period_code'])){
				$edu_period_code['edu_period_code'] = $param['edu_period_code'];
				$edu_period = $this->db->get_where('educational_period',$edu_period_code);
				if($edu_period->num_rows() > 0){
					$input['edu_period_id'] = $edu_period->row()->edu_period_id;
				} 
			}

			if(isset($param['class_code'])){
				$class_code['class_code'] = $param['class_code'];
				$class = $this->db->get_where('class',$class_code);
				if($class->num_rows() > 0){
					$input['class_id'] = $class->row()->class_id;
				} 
			}

			if($this->schedule_m->db->insert('course_schedule',$input)){
				$last_id = $this->db->insert_id();
				$status = true;
				$message = "OK";
			} else {
				$last_id = "0";
				$status = false;
				$message = $this->db->error();
			}
		}
		
		echo json_encode(array('status' => $status, 'schedule_id' => $last_id, 'message' => $message ));
	}
		
}
