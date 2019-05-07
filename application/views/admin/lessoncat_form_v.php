<?php
	include 'header.php';
?>
<div class="d-flex flex-grow-1">
<?php
	include 'sidebar.php';
?>
<main role="main" class="col-md-auto h-100 flex-grow-1">
	<div class="col-md-12 mx-auto my-5">
		<form class="col-auto px-1" method="post">
			<div class="col-12 mb-4">
				<h2 class="page-title">
					<?php if($this->input->post('action') == 'edit'){ ?>
						Edit Kategori Pelajaran
						<input type="hidden" name="action" value="update">
					<?php } else { ?>  
						Tambah Kategori Pelajaran
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
				<?php if(isset($lessoncat->lesson_cat_id)){ ?>
				<div class="form-group">
					<label for="lesson_cat_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<input type="hidden" id="lesson_cat_id" name="lesson_cat_id" value="<?=isset($lessoncat->lesson_cat_id) ? $lessoncat->lesson_cat_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label for="staticEmail" class="col-sm-12 col-form-label"> Kat. Pelajaran</label>
					<div class="col-sm-12">
						<input type="text" id="lesson_category" class="form-control" name="lesson_category" value="<?=isset($lessoncat->lesson_category) ? $lessoncat->lesson_category : ''; ?>" />
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