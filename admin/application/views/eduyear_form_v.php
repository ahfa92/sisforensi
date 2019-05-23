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
						Edit Tahun Ajar
						<input type="hidden" name="action" value="update">
					<?php } else { ?>  
						Tambah Tahun Ajar
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

			<div class="col-12 col-md-6 offset-md-3">
				<?php if(isset($eduyear->edu_year_id)){ ?>
				<div class="form-group">
					<label for="edu_year_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<?=$eduyear->edu_year_id;?>
						<input type="hidden" id="edu_year_id" name="edu_year_id" value="<?=isset($eduyear->edu_year_id) ? $eduyear->edu_year_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label for="edu_year_code" class="col-sm-12 col-form-label"> Kode Tahun</label>
					<div class="col-sm-12">
						<input type="text" id="edu_year_code" class="form-control" name="edu_year_code" value="<?=isset($eduyear->edu_year_code) ? $eduyear->edu_year_code : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="edu_year_name" class="col-sm-12 col-form-label"> Nama Tahun Ajar</label>
					<div class="col-sm-12">
						<input type="text" id="edu_year_name" class="form-control" name="edu_year_name" value="<?=isset($eduyear->edu_year_name) ? $eduyear->edu_year_name : ''; ?>" />
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