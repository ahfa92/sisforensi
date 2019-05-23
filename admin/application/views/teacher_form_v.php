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
				<?php if(isset($teacher->teacher_id)){ ?>
				<div class="form-group">
					<label for="teacher_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<input type="hidden" id="teacher_id" name="teacher_id" value="<?=isset($teacher->teacher_id) ? $teacher->teacher_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="col-sm-12 form-group">
					<label class="col-form-label"> Kredensial</label>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="nip" class="col-sm-12 col-form-label"> NIP </label>
							<div class="col-sm-12">
								<input type="text" id="nip" class="form-control" name="nip" value="<?=isset($teacher->nip) ? $teacher->nip : ''; ?>" />
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="teacher_email" class="col-sm-12 col-form-label"> E-Mail </label>
							<div class="col-sm-12">
								<input type="email" id="teacher_email" class="form-control" name="teacher_email" value="<?=isset($teacher->teacher_email) ? $teacher->teacher_email : ''; ?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 form-group">
					<label class="col-form-label"> Data Guru</label>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="teacher_name" class="col-sm-12 col-form-label"> Nama Depan</label>
							<div class="col-sm-12">
								<input type="text" id="teacher_firstname" class="form-control" name="teacher_firstname" value="<?=isset($teacher->teacher_firstname) ? $teacher->teacher_firstname : ''; ?>" />
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="teacher_name" class="col-sm-12 col-form-label"> Nama Belakang</label>
							<div class="col-sm-12">
								<input type="text" id="teacher_lastname" class="form-control" name="teacher_lastname" value="<?=isset($teacher->teacher_lastname) ? $teacher->teacher_lastname : ''; ?>" />
							</div>
						</div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="teacher_birthplace" class="col-sm-12 col-form-label"> Tempat Lahir </label>
							<div class="col-sm-12">
								<select id="teacher_birthplace" class="form-control" name="teacher_birthplace">
									<option value="">Pilih Tempat Lahir</option>
									<?php if($birthplaces->num_rows() > 0) { ?>
										<?php foreach($birthplaces->result() as $bp) { ?>
											<option value="<?=$bp->district_id;?>" <?=(isset($teacher->teacher_birthplace) && $teacher->teacher_birthplace == $bp->district_id) ? 'selected' : ''; ?>><?=$bp->district_name;?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="teacher_birthdate" class="col-sm-12 col-form-label"> Tanggal Lahir</label>
							<div class="col-sm-12">
								<input type="date" id="teacher_birthdate" class="form-control" name="teacher_birthdate" value="<?=isset($teacher->teacher_birthdate) ? $teacher->teacher_birthdate : ''; ?>" />
							</div>
						</div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label class="col-sm-12 col-form-label"> Jenis Kelamin </label>
							<div class="col-sm-12">
								<select id="teacher_gender" name="teacher_gender" class="form-control">
									<datalist>
										<option value="">Pilih Gender</option>
										<option value="1" <?=isset($teacher->teacher_gender) && $teacher->teacher_gender == '1' ? 'selected' : ''; ?>>Laki-laki</option>
										<option value="2" <?=isset($teacher->teacher_gender) && $teacher->teacher_gender == '2' ? 'selected' : ''; ?>>Perempuan</option>
									</datalist>
								</select>
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="teacher_phone" class="col-sm-12 col-form-label"> Phone </label>
							<div class="col-sm-12">
								<input type="text" id="teacher_phone" class="form-control" name="teacher_phone" value="<?=isset($teacher->teacher_phone) ? $teacher->teacher_phone : ''; ?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 form-group">
					<label class="col-form-label">Data Alamat</label>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="province" class="col-sm-12 col-form-label"> Provinsi </label>
							<div class="col-sm-12">
								<select id="province" class="select-province form-control" data-district="district">
									<datalist>
									<?php if($provs->num_rows() > 0) { ?>
										<option value="">Select Province</option>
										<?php foreach($provs->result() as $prov) { ?>
											<option value="<?=$prov->province_id;?>" <?=isset($teacher->province_id) && $teacher->province_id == $prov->province_id ? 'selected' : ''; ?>><?=$prov->province_name;?></option>
										<?php } ?>
									<?php } else { ?>
										<option value="">No Data</option>
									<?php } ?>
									</datalist>
								</select>
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="district" class="col-sm-12 col-form-label"> Kabupaten/Kota </label>
							<div class="col-sm-12">
								<select id="district" class="select-district form-control" data-subdistrict="subdistrict">
									<datalist>
									<?php if($this->input->post("action") == 'new') { ?>
										<option value="">Pilih Kabupaten/Kota</option>
									<?php } else { ?>
										<?php if($dists->num_rows() > 0) { ?>
											<option value="">Pilih Kabupaten/Kota</option>
											<?php foreach($dists->result() as $dist) { ?>
												<option value="<?=$dist->district_id;?>" <?=isset($teacher->district_id) && $teacher->district_id == $dist->district_id ? 'selected' : ''; ?>><?=$dist->district_name;?></option>
											<?php } ?>
										<?php } else { ?>
											<option value="">No Data</option>
										<?php } ?>
									<?php } ?>
									</datalist>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="subdistrict" class="col-sm-12 col-form-label"> Kecamatan </label>
							<div class="col-sm-12">
								<select id="subdistrict" class="select-subdistrict form-control" data-village="village">
									<datalist>
									<?php if($this->input->post("action") == 'new') { ?>
										<option value="">Pilih Kecamatan</option>
									<?php } else { ?>
										<?php if($sdists->num_rows() > 0) { ?>
											<option value="">Pilih Kecamatan</option>
											<?php foreach($sdists->result() as $sdist) { ?>
												<option value="<?=$sdist->subdistrict_id;?>" <?=isset($teacher->subdistrict_id) && $teacher->subdistrict_id == $sdist->subdistrict_id ? 'selected' : ''; ?>><?=$sdist->subdistrict_name;?></option>
											<?php } ?>
										<?php } else { ?>
											<option value="">No Data</option>
										<?php } ?>
									<?php } ?>
									</datalist>
								</select>
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="village" class="col-sm-12 col-form-label"> Kelurahan </label>
							<div class="col-sm-12">
								<select id="village" name="teacher_geo_address" class="select-village form-control">
									<datalist>
									<?php if($this->input->post("action") == 'new') { ?>
										<option value="">Pilih Kelurahan</option>
									<?php } else { ?>
										<?php if($vlgs->num_rows() > 0) { ?>
											<option value="">Pilih Kabupaten/Kota</option>
											<?php foreach($vlgs->result() as $vlg) { ?>
												<option value="<?=$vlg->village_id;?>" <?=isset($teacher->village_id) && $teacher->village_id == $vlg->village_id ? 'selected' : ''; ?>><?=$vlg->village_name;?></option>
											<?php } ?>
										<?php } else { ?>
											<option value="">No Data</option>
										<?php } ?>
									<?php } ?>
									</datalist>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="teacher_address" class="col-sm-12 col-form-label"> Alamat</label>
						<div class="col-sm-12">
							<textarea id="teacher_address" class="form-control" name="teacher_address" ><?=isset($teacher->teacher_address) ? $teacher->teacher_address : ''; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-sm-12 form-group">
					<label  for="teacher_joindate" class="col-form-label"> Tanggal Mulai Mengajar</label>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<div class="col-sm-12">
								<input type="date" id="teacher_joindate" class="form-control" name="teacher_joindate" value="<?=isset($teacher->teacher_joindate) ? $teacher->teacher_joindate : ''; ?>" />
							</div>
						</div>
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