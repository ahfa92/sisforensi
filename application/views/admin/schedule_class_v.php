<?php
	include 'header.php';
?>
<div class="d-flex flex-grow-1 vw-100">
<?php
	include 'sidebar.php';
?>
<main role="main" class="col-md-10 h-100 flex-grow-1">
	<div class="col-12 mb-4">
		<h2 class="page-title">Timetable</h2>
	</div>

	<?php if(!empty($page['message'])){ ?>
	<div class="col-12 mb-2">
		<div class="alert alert-success alert-dismissible fade show" role="alert"><?=$page['message']?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php } ?>
	<div class="col-12 mb-2">
		<form action="<?=site_url('admin/timetable')?>" class="form-inline">
			<div class="input-group mb-2 mr-sm-2">
			    <div class="input-group-prepend">
			    	<div class="input-group-text">Tahun Ajaran</div>
			    </div>
				<select id="edu_year_code" name="edu_year_code" class="form-control">
					<option value="">Pilih Tahun</option>
				<?php if($edu_years->num_rows() > 0) { ?>
					<?php foreach($edu_years->result() as $edu_year) { ?>
						<option value="<?=$edu_year->edu_year_code?>" <?=($edu_year->edu_year_code == $this->input->get('edu_year_code') ? "selected" : "");?>><?=$edu_year->edu_year_name;?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
			<div class="input-group mb-2 mr-sm-2">
			    <div class="input-group-prepend">
			    	<div class="input-group-text">Kelas</div>
			    </div>
				<select id="class_code" name="class_code" class="form-control">
					<option value="">Pilih Kelas</option>
				<?php if($classes->num_rows() > 0) { ?>
					<?php foreach($classes->result() as $class) { ?>
						<option value="<?=$class->class_code;?>" <?=($class->class_code == $this->input->get('class_code') ? "selected" : "");?>><?=$class->class_name;?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
			<div class="input-group mb-2 mr-sm-2">
			    <button id="btn-search"class="btn btn-info" type="submit" name="action" value="search"><i class="fa fa-search"></i></button>
			</div>
			<?php if(!empty($this->input->get('edu_year_code')) && !empty($this->input->get('class_code'))) { ?>
			<div class="input-group mb-2 mr-sm-2">
				<input type="hidden" id="hidden-edit">
			    <button id="btn-edit" class="btn btn-success" type="submit" name="action" value="edit">Edit</button>
			</div>
			<?php } ?>
		</form>
	</div>
	<div class="col-12 table-responsive">
		<table id="table-schedule" class="table table-hover datatables">
			<thead>
				<?php if($this->input->get('action') == null) { ?>
				<tr>
					<th class="text-center">Periode</th>
					<?php foreach ($days as $i) { ?>
						<th class="text-center"><?=dayname($i);?></th>
					<?php } ?>
				</tr>
					<?php } else { ?>
				<tr>
					<th class="text-center align-middle" rowspan="2">Periode</th>
					<?php foreach ($days as $i) { ?>
						<th class="text-center">
						<?php if($this->input->get('action') == 'search') { ?>
							<button type="button" class="btn-success btn-edit-day" data-day="<?=$i;?>">Edit</button>
						<?php } else if($this->input->get('day') == $i) { ?>
							<button type="button" class="btn-primary btn-edit-close" data-day="<?=$i;?>">Back</button>
						<?php } ?>
						</th>
					<?php } ?>
					<th class="text-center align-middle" rowspan="2">Action</th>
				</tr>
				<tr>
					<?php foreach ($days as $i) { ?>
						<th class="text-center"><?=dayname($i);?></th>
					<?php } ?>
				</tr>
					<?php } ?>
			</thead>
			<tbody>
			<?php 
			if($this->input->get('action') == 'search' || $this->input->get('action') == 'edit') {
				foreach ($schedules as $p => $period) { ?>
					<tr>
						<?php foreach ($period as $d => $schedule) { ?>
							<?php if($d == 'detail') { ?>
								<td class="text-center align-middle" nowrap="nowrap">
									<?=$schedule->period_name?><br/>
										<span class="small"><?=date('h:i',strtotime($schedule->period_start_time)).'-'.date('h:i',strtotime($schedule->period_end_time));?></span>
									</td>
							<?php } else { ?>
								<?php if($this->input->get('day') != $d && $this->input->get('period_id') != $period['detail']->period_id) { ?>
								<td class="table-item text-center align-middle" data-id="<?=($schedule) ? $schedule->schedule_id : '0';?>" data-day="<?=$d;?>" data-period="<?=$period['detail']->period_id;?>">
									<?=($schedule && !empty($schedule->lesson_name)) ? $schedule->lesson_name : "No Schedule"  ?></td>
								<?php } else { ?>
								<td class="table-item-edit text-center align-middle" data-id="<?=($schedule) ? $schedule->schedule_id : '0';?>" data-day="<?=$d;?>" data-period="<?=$period['detail']->period_id;?>">
									<select id="course_id" name="course_id" class="course_ids form-control-sm" style="text-align-last: center;">
										<option value="" class="text-center w-100">--MP--</option>
										<?php foreach($courses->result() as $course) { ?>
											<option value="<?=$course->course_id;?>" <?=($schedule && $schedule->lesson_id == $course->lesson_id) ? "selected" : ""; ?>><?=$course->lesson_name;?></option>
										<?php } ?>	
									</select>
									</td>
								<?php } ?>
							<?php } ?>
						<?php } ?>
						<td class="text-center align-middle">
						<?php if($this->input->get('action') == 'search') { ?>
							<button type="button" class="btn-success btn-edit-period" data-period="<?=$period['detail']->period_id;?>">Edit</button>
						<?php } else if($this->input->get('period_id') == $period['detail']->period_id) { ?>
							<button type="button" class="btn-primary btn-edit-close" data-day="<?=$period['detail']->period_id;?>">Back</button>
						<?php } ?>	
						</td>
					</tr>
				<?php }
				} ?>
			</tbody>
		</table>
	</div>
</main>
</div>
<?php
	include 'footer.php';
	include 'main_js.php';
?>
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal-body" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	function openassignment(el) {
		let schedule_id = $(el).attr('data-id');
		$.ajax({
				url: "<?=site_url('api/scheduledetail')?>",
				data: {schedule_id:schedule_id},
				dataType:"json"
			}).done(function(resp){
				$('#modal-title').html(resp.title);
				$('#modal-body').html(resp.html);
				$('#modal-info').modal('show');
			});
	}

	$('.course_ids').on('change',function(e){
		let el = $(this);
		let container = $(this).closest('.table-item-edit');
		let data = {
			schedule_id: container.attr('data-id'),
			day: container.attr('data-day'),
			period_id: container.attr('data-period'),
			course_id: $(this).val()
		};

		console.log(data);
		$.ajax({
			url: "<?=site_url('api/updateschedule')?>",
			data: data,
			dataType:"json"
		}).done(function(resp){
			if(resp.status){
				container.attr('data-id',resp.schedule_id);
			}
		});
	});

	$('.btn-edit-period').on('click',function(e){
		$('#hidden-edit').attr('name','period_id').val($(this).attr('data-period'));
		$('#btn-edit').click();
	});

	$('.btn-edit-day').on('click',function(e){
		$('#hidden-edit').attr('name','day').val($(this).attr('data-day'));
		$('#btn-edit').click();
	});

	$('.btn-edit-close').on('click',function(e){
		$('#btn-search').click();
	});

</script>
</body>
</html>