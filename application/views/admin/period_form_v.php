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
						Edit Periode
						<input type="hidden" name="action" value="update">
					<?php } else { ?>  
						Tambah Periode
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
				<?php if(isset($period->period_id)){ ?>
				<div class="form-group">
					<label for="period_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<input type="hidden" id="period_id" name="period_id" value="<?=isset($period->period_id) ? $period->period_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label for="period_name" class="col-sm-12 col-form-label"> Nama Liburan</label>
					<div class="col-sm-12">
						<input type="text" id="period_name" class="form-control" name="period_name" value="<?=isset($period->period_name) ? $period->period_name : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="period_start_time" class="col-sm-12 col-form-label"> Jam Mulai</label>
					<div class="col-sm-12">
						<input type="time" id="period_start_time" class="form-control" name="period_start_time" value="<?=isset($period->period_start_time) ? $period->period_start_time : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="period_end_time" class="col-sm-12 col-form-label"> Jam Selesai</label>
					<div class="col-sm-12">
						<input type="time" id="period_end_time" class="form-control" name="period_end_time" value="<?=isset($period->period_end_time) ? $period->period_end_time : ''; ?>" />
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