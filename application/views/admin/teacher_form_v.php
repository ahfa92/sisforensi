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
				<?php if(isset($teacher->teacher_id)){ ?>
				<div class="form-group">
					<label for="teacher_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<input type="hidden" id="teacher_id" name="teacher_id" value="<?=isset($teacher->teacher_id) ? $teacher->teacher_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="form-group row mb-0">
					<div class="col-sm-6 form-group">
						<label for="nip" class="col-sm-12 col-form-label"> NIP </label>
						<div class="col-sm-12">
							<input type="text" id="nip" class="form-control" name="nip" value="<?=isset($teacher->nip) ? $teacher->nip : ''; ?>" />
						</div>
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-sm-6 form-group">
						<label for="teacher_name" class="col-sm-12 col-form-label"> Nama Depan</label>
						<div class="col-sm-12">
							<input type="text" id="teacher_name" class="form-control" name="teacher_name" value="<?=isset($teacher->teacher_name) ? $teacher->teacher_name : ''; ?>" />
						</div>
					</div>
					<div class="col-sm-6 form-group">
						<label for="teacher_name" class="col-sm-12 col-form-label"> Nama Belakang</label>
						<div class="col-sm-12">
							<input type="text" id="teacher_name" class="form-control" name="teacher_name" value="<?=isset($teacher->teacher_name) ? $teacher->teacher_name : ''; ?>" />
						</div>
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-sm-6 form-group">
						<label for="teacher_birthplace" class="col-sm-12 col-form-label"> Tempat Lahir </label>
						<div class="col-sm-12">
							<select id="teacher_birthplace" class="form-control" name="teacher_birthplace">
								<datalist>
								<?php if($dists->num_rows() > 0) { ?>
									<option value="">Select City</option>
									<?php foreach($dists->result() as $dist) { ?>
										<option value="<?=$dist->district_id;?>" <?=isset($teacher->teacher_birthplace) && $teacher->teacher_birthplace == $dist->district_id ? 'selected' : ''; ?>><?=$dist->district_name;?></option>
									<?php } ?>
								<?php } else { ?>
									<option value="">No Data</option>
								<?php } ?>
								</datalist>
							</select>
						</div>
					</div>
					<div class="col-sm-6 form-group">
						<label for="teacher_birthdate" class="col-sm-12 col-form-label"> Tgl Lahir</label>
						<div class="col-sm-12">
							<input type="date" id="teacher_birthdate" class="form-control" name="teacher_birthdate" value="<?=isset($teacher->teacher_birthdate) ? $teacher->teacher_birthdate : ''; ?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="teacher_address" class="col-sm-12 col-form-label"> Alamat</label>
					<div class="col-sm-12">
						<textarea id="teacher_address" class="form-control" name="teacher_address" value="<?=isset($teacher->teacher_address) ? $teacher->teacher_address : ''; ?>" ></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="teacher_start" class="col-sm-12 col-form-label"> Tanggal Mulai</label>
					<div class="col-sm-12">
						<input type="date" id="teacher_start" class="form-control" name="teacher_start" value="<?=isset($teacher->teacher_start) ? $teacher->teacher_start : ''; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="teacher_end" class="col-sm-12 col-form-label"> Tanggal Mulai</label>
					<div class="col-sm-12">
						<input type="date" id="teacher_end" class="form-control" name="teacher_end" value="<?=isset($teacher->teacher_end) ? $teacher->teacher_end : ''; ?>" />
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