<?php
	include 'header.php';
?>
<div class="d-flex flex-grow-1">
<?php
	include 'sidebar.php';
?>
<main role="main" class="col-md-10 h-100 flex-grow-1">
	<div class="col-md-12 mx-auto my-5">
		<form class="col-auto px-1" method="post">
			<div class="col-12 mb-4">
				<h2 class="page-title">
					<?php if($this->input->post('action') == 'edit'){ ?>
						Edit Guru
						<input type="hidden" name="action" value="update">
					<?php } else { ?>  
						Tambah Guru
						<input type="hidden" name="action" value="create">
					<?php } ?>
				</h2>
			</div>

			<?php if(!empty($page['message'])){ ?>
			<div class="col-12 mb-4">
				<div class="alert alert-success alert-dismissible fade show" role="alert"><?=$page['message']?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php } ?>
			<div class="col-12">
				<div class="col-12 input-group mb-2 mr-sm-2">
				    <div class="input-group-prepend">
				    	<div class="input-group-text">Periode Ajar</div>
				    </div>
					<select id="edu_period_id" name="edu_period_id" class="form-control">
					<?php if($edu_periods->num_rows() > 0) { ?>
						<?php foreach($edu_periods->result() as $edu_period) { ?>
							<option value="<?=$edu_period->edu_period_id?>" <?=(isset($course->edu_period_id) && $edu_period->edu_period_id == $course->edu_period_id ? "selected" : "");?>><?=$edu_period->edu_period_code;?></option>
						<?php } ?>
					<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-12">
				<?php if(isset($course->course_id)){ ?>
				<div class="form-group">
					<label for="course_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<?=$course->course_id;?>
						<input type="hidden" id="course_id" name="course_id" value="<?=isset($course->course_id) ? $course->course_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label class="col-sm-12 col-form-label">Kelas</label>
					<div class="col-sm-12">
						<select id="class_id" name="class_id" class="form-control">
						<?php if($classes->num_rows() > 0) { ?>
							<option value="">Pilih Kelas</option>
							<?php foreach($classes->result() as $class) { ?>
								<option value="<?=$class->class_id?>" <?=(isset($course->class_id) && $class->class_id == $course->class_id ? "selected" : "");?>><?=$class->class_name;?></option>
							<?php } ?>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 col-form-label">Mata Pelajaran</label>
					<div class="col-sm-12">
						<select id="lesson_id" name="lesson_id" class="form-control">
						<?php if($lessons->num_rows() > 0) { ?>
							<option value="">Pilih Mata Pelajaran</option>
							<?php foreach($lessons->result() as $lesson) { ?>
								<option value="<?=$lesson->lesson_id?>" <?=(isset($course->lesson_id) && $lesson->lesson_id == $course->lesson_id ? "selected" : "");?>><?=$lesson->lesson_name;?></option>
							<?php } ?>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 col-form-label">Guru Pengajar</label>
					<div class="col-sm-12">
						<select id="teacher_id" name="teacher_id" class="form-control">
						<?php if($teachers->num_rows() > 0) { ?>
							<option value="">Pilih Guru</option>
							<?php foreach($teachers->result() as $teacher) { ?>
								<option value="<?=$teacher->teacher_id?>" <?=(isset($course->teacher_id) && $teacher->teacher_id == $course->teacher_id ? "selected" : "");?>><?=trim($teacher->teacher_firstname." ".$teacher->teacher_lastname);?></option>
							<?php } ?>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-12 text-center">
						<button class="btn btn-success" type="submit">Simpan</button>
						<a class="btn btn-light" href=""> Back </a>
					</div>
				</div>
			</div>
		</form>
	</div>
</main>
</div>
<?php
	include 'footer.php';
	include 'main_js.php';
?>
<script type="text/javascript">
	
</script>
</body>
</html>