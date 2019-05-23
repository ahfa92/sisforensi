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
						Edit Periode Ajar
						<input type="hidden" name="action" value="update">
					<?php } else { ?>  
						Tambah Periode Ajar
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
				<?php if(isset($eduperiod->edu_period_id)){ ?>
				<div class="form-group">
					<label for="edu_period_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<input type="hidden" id="edu_period_id" name="edu_period_id" value="<?=isset($eduperiod->edu_period_id) ? $eduperiod->edu_period_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label for="edu_year_id" class="col-sm-12 col-form-label"> Tahun Ajar </label>
					<div class="col-sm-12">
						<select id="edu_year_id" class="form-control" name="edu_year_id" required>
							<option value="">Pilih Tahun Ajar</option>
							<?php foreach($edu_years->result() as $edu_year) { ?>
								<option value="<?=$edu_year->edu_year_id;?>" <?=(isset($eduperiod->edu_year_id) && $eduperiod->edu_year_id == $edu_year->edu_year_id) ? 'selected' : ''; ?>><?=$edu_year->edu_year_name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="edu_period_type" class="col-sm-12 col-form-label"> Tipe Periode Ajar </label>
					<div class="col-sm-12">
						<select id="edu_period_type" class="form-control" name="edu_period_type" required>
							<option value="">Pilih Tipe Periode</option>
							<?php foreach(periodtype('all') as $id => $val) { ?>
								<option value="<?=$id;?>" <?=(isset($eduperiod->edu_period_type) && $eduperiod->edu_period_type == $id) ? 'selected' : ''; ?>><?=$val;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="edu_period_num" class="col-sm-12 col-form-label">  Periode Ke</label>
					<div class="col-sm-12">
						<input type="text" id="edu_period_num" class="form-control" name="edu_period_num" value="<?=isset($eduperiod->edu_period_num) ? $eduperiod->edu_period_num : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="edu_period_start" class="col-sm-12 col-form-label">  Tanggal Mulai Periode</label>
					<div class="col-sm-12">
						<input type="date" id="edu_period_start" class="form-control" name="edu_period_start" value="<?=isset($eduperiod->edu_period_start) ? $eduperiod->edu_period_start : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="edu_period_end" class="col-sm-12 col-form-label">  Tanggal Akhir Periode</label>
					<div class="col-sm-12">
						<input type="date" id="edu_period_end" class="form-control" name="edu_period_end" value="<?=isset($eduperiod->edu_period_end) ? $eduperiod->edu_period_end : ''; ?>" />
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