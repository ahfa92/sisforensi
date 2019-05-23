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
						Edit Mata Pelajaran
						<input type="hidden" name="action" value="update">
					<?php } else { ?>  
						Tambah Mata Pelajaran
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
				<?php if(isset($lesson->lesson_id)){ ?>
				<div class="form-group">
					<label for="lesson_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<input type="hidden" id="lesson_id" name="lesson_id" value="<?=isset($lesson->lesson_id) ? $lesson->lesson_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label for="lesson_name" class="col-sm-12 col-form-label"> Mata Pelajaran</label>
					<div class="col-sm-12">
						<input type="text" id="lesson_name" class="form-control" name="lesson_name" value="<?=isset($lesson->lesson_name) ? $lesson->lesson_name : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="lesson_cat_id" class="col-sm-12 col-form-label">Kategori Pelajaran</label>
					<div class="col-sm-12">
						<select id="lesson_cat_id" class="form-control" name="lesson_cat_id">
							<datalist>
							<?php if($cats->num_rows() > 0){ ?>
								<option value="">Select Category</option>
								<?php foreach($cats->result() as $k => $cat) { ?> 
									<option value="<?=$cat->lesson_cat_id;?>" <?=(isset($lesson->lesson_cat_id) && $cat->lesson_cat_id == $lesson->lesson_cat_id ? 'selected' : '');?>><?=$cat->lesson_category;?></option>
								<?php } ?> 
							<?php } else { ?>
								<option value="">No Data</option>
							<?php } ?>
							</datalist>
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