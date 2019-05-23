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
						Edit Kelas
						<input type="hidden" name="action" value="update">
					<?php } else { ?>  
						Tambah Kelas
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
				<?php if(isset($class->class_id)){ ?>
				<div class="form-group">
					<label for="class_id" class="col-sm-2 col-form-label">ID</label>
					<div class="col-sm-10">
						<input type="hidden" id="class_id" name="class_id" value="<?=isset($class->class_id) ? $class->class_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label for="staticEmail" class="col-sm-2 col-form-label">Nama Kelas</label>
					<div class="col-sm-10">
						<input type="text" id="class_name" class="form-control" name="class_name" value="<?=isset($class->class_name) ? $class->class_name : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="class_tier" class="col-sm-2 col-form-label">Tingkat Kelas</label>
					<div class="col-sm-10">
						<select id="class_tier" class="form-control" name="class_tier">
							<datalist>
							<?php for ($i=1; $i <= 12; $i++) { ?> 
								<option <?=(isset($class->class_tier) && $i == $class->class_tier ? 'selected' : '');?>><?=$i;?></option>
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