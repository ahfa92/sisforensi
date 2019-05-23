<?php
	include 'header.php';
?>
<div class="d-flex flex-grow-1 vw-100">
<?php
	include 'sidebar.php';
?>
<main role="main" class="col-md-10 h-100 flex-grow-1">
	<div class="col-12 mb-4">
		<h2 class="page-title">Jadwal Mengajar</h2>
	</div>

	<?php if(!empty($page['message'])){ ?>
	<div class="col-12 mb-4">
		<div class="alert alert-success alert-dismissible fade show" role="alert"><?=$page['message']?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php } ?>
	<div class="col-12 mb-4 text-right">
		<form action="" method="post">
			<button type="submit" name="action" value="new" class="btn btn-primary">
				<h4 class="mb-0 mx-5">New</h4>
			</button>
		</form>
	</div>
	<div class="col-12 my-4">
		<form action="" class="form-inline">
			<div class="input-group mb-2 mr-sm-2">
			    <div class="input-group-prepend">
			    	<div class="input-group-text">TA</div>
			    </div>
				<select id="edu_year_code" name="edu_year_code" <?=isset($_GET['edu_year_code']) ? 'data-old="'.$_GET['edu_year_code'].'"' : '';?> class="form-control">
				<option value="">Tahun Ajar</option>
				<?php if($edu_years->num_rows() > 0) { ?>
					<?php foreach($edu_years->result() as $edu_year) { ?>
						<option value="<?=$edu_year->edu_year_code?>" <?=isset($_GET['edu_year_code']) && $edu_year->edu_year_code == $_GET['edu_year_code'] ? "selected" : ""; ?>><?=$edu_year->edu_year_name;?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
			<div class="input-group mb-2 mr-sm-2">
			    <div class="input-group-prepend">
			    	<div class="input-group-text">Periode</div>
			    </div>
				<select id="edu_period_code" name="edu_period_code" class="form-control change-submit">
				<option value="">Periode Ajar</option>
				<?php if($edu_periods->num_rows() > 0) { ?>
					<?php foreach($edu_periods->result() as $edu_period) { ?>
						<option value="<?=$edu_period->edu_period_code?>" <?=isset($_GET['edu_period_code']) && $edu_period->edu_period_code == $_GET['edu_period_code'] ? "selected" : ""; ?>><?=$edu_period->edu_period_code;?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
			<div class="input-group mb-2 mr-sm-2">
			    <div class="input-group-prepend">
			    	<div class="input-group-text">Kelas</div>
			    </div>
				<select id="class_code" name="class_code" class="form-control change-submit">
				<option value="">Pilih Kelas</option>
				<?php if($classes->num_rows() > 0) { ?>
					<?php foreach($classes->result() as $class) { ?>
						<option value="<?=$class->class_code?>" <?=isset($_GET['class_code']) && $class->class_code == $_GET['class_code'] ? "selected" : ""; ?>><?=$class->class_name;?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
			<div class="input-group mb-2 mr-sm-2">
			    <div class="input-group-prepend">
			    	<div class="input-group-text">MP</div>
			    </div>
				<select id="lesson_code" name="lesson_code" class="form-control change-submit">
				<option value="">Mt Pelajaran</option>
				<?php if($lessons->num_rows() > 0) { ?>
					<?php foreach($lessons->result() as $lesson) { ?>
						<option value="<?=$lesson->lesson_code?>" <?=isset($_GET['lesson_code']) && $lesson->lesson_code == $_GET['lesson_code'] ? "selected" : ""; ?>><?=$lesson->lesson_name;?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
			<div class="input-group mb-2 mr-sm-2">
			    <div class="input-group-prepend">
			    	<div class="input-group-text">Guru MP</div>
			    </div>
				<select id="teacher_code" name="teacher_code" class="form-control change-submit">
				<option value="">Guru MP</option>
				<?php if($teachers->num_rows() > 0) { ?>
					<?php foreach($teachers->result() as $teacher) { ?>
						<option value="<?=$teacher->teacher_code?>" <?=isset($_GET['teacher_code']) && $teacher->teacher_code == $_GET['teacher_code'] ? "selected" : ""; ?>><?=$teacher->teacher_code;?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
		</form>
	</div>
	<div class="col-12 table-responsive">
		<table id="table-course" class="table table-hover datatables">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Jadwal</th>
					<th>Tahun Ajar</th>
					<th>Periode Ajar</th>
					<th>Nama Kelas</th>
					<th>Tingkat</th>
					<th>Mata Pelajaran</th>
					<th>Guru Pengajar</th>
					<th style="max-width: 20%;">Action</th>
				</tr>
			</thead>
			<?php 
			if($courses->num_rows() > 0){
				$no = 1;
			?>
			<tbody>
			<?php foreach($courses->result() as $course){ ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$course->course_code?></td>
					<td><?=$course->edu_year_name?></td>
					<td><?=$course->edu_period_code?></td>
					<td><?=$course->class_name?></td>
					<td><?=$course->class_tier?></td>
					<td><?=$course->lesson_name?></td>
					<td><?=trim($course->teacher_code." / ".$course->teacher_firstname." ".$course->teacher_lastname);?></td>
					<td style="max-width: 20%;">
						<div class="d-flex w-100">
							<form action="<?=site_url('timetable');?>" class="col-auto px-1">
								<input type="hidden" name="edu_year_code" value="<?=$course->edu_year_code?>" />
								<input type="hidden" name="edu_period_code" value="<?=$course->edu_period_code?>" />
								<input type="hidden" name="class_code" value="<?=$course->class_code?>" />
								<button type="submit" class="btn btn-info btn-sm" name="action" value="search"><i class="fa fa-calendar"></i></button>
							</form>
							<form action="<?=site_url('jadwal');?>" class="col-auto px-1" method="post">
								<input type="hidden" name="course_id" value="<?=$course->course_id?>" />
								<input type="hidden" name="action" value="edit" />
								<button type="submit" class="btn btn-warning btn-sm" style="color:white;"><i class="fa fa-edit"></i></button>
							</form>
							<form class="col-auto px-1" method="post"> 
								<input type="hidden" name="course_id" value="<?=$course->course_id?>" />
								<input type="hidden" name="action" value="delete" />
								<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-window-close"></i></button>
							</form>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
			<?php } ?>
		</table>
	</div>
</main>
</div>
<?php
	include 'footer.php';
	include 'main_js.php';
?>
<script type="text/javascript">
	$('#edu_year_code').on('change',function(e){
		let old = $(this).attr('data-old');
		let sub = $('#edu_period_code');
		let year = $(this).val();

		$(this).attr('data-old',year);

		if(year != old || year == '') {
			sub.find('option').not(':first').remove();
			sub.val('');
			if(year.length){
				$.ajax({
					url: "<?=site_url('api/eduperiod')?>",
					data: {edu_year_code:year},
					dataType:"json"
				}).done(function(resp){
					sub.append(resp.html);
				});
			}
		}
	});

	$('#edu_year_code').change();
</script>
</body>
</html>