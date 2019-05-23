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
						Edit Murid
						<input type="hidden" name="action" value="update">
					<?php } else { ?>  
						Tambah Murid
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
				<?php if(isset($student->student_id)){ ?>
				<div class="form-group">
					<label for="student_id" class="col-sm-12 col-form-label">ID</label>
					<div class="col-sm-12">
						<input type="hidden" id="student_id" name="student_id" value="<?=isset($student->student_id) ? $student->student_id : ''; ?>" />
					</div>
				</div>
				<?php } ?>
				<div class="col-sm-12 form-group">
					<label class="col-form-label"> Kredensial</label>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="nis" class="col-sm-12 col-form-label"> NIS </label>
							<div class="col-sm-12">
								<input type="text" id="nis" class="form-control" name="nis" value="<?=isset($student->nis) ? $student->nis : ''; ?>" />
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="nisn" class="col-sm-12 col-form-label"> NISN </label>
							<div class="col-sm-12">
								<input type="text" id="nisn" class="form-control" name="nisn" value="<?=isset($student->nisn) ? $student->nisn : ''; ?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 form-group">
					<label class="col-form-label"> Data Murid</label>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="student_name" class="col-sm-12 col-form-label"> Nama Depan</label>
							<div class="col-sm-12">
								<input type="text" id="student_firstname" class="form-control" name="student_firstname" value="<?=isset($student->student_firstname) ? $student->student_firstname : ''; ?>" />
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="student_name" class="col-sm-12 col-form-label"> Nama Belakang</label>
							<div class="col-sm-12">
								<input type="text" id="student_lastname" class="form-control" name="student_lastname" value="<?=isset($student->student_lastname) ? $student->student_lastname : ''; ?>" />
							</div>
						</div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="student_birthplace" class="col-sm-12 col-form-label"> Tempat Lahir </label>
							<div class="col-sm-12">
								<select id="student_birthplace" class="form-control" name="student_birthplace">
									<option value="">Pilih Tempat Lahir</option>
									<?php if($birthplaces->num_rows() > 0) { ?>
										<?php foreach($birthplaces->result() as $bp) { ?>
											<option value="<?=$bp->district_id;?>" <?=(isset($student->student_birthplace) && $student->student_birthplace == $bp->district_id) ? 'selected' : ''; ?>><?=$bp->district_name;?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="student_birthdate" class="col-sm-12 col-form-label"> Tanggal Lahir</label>
							<div class="col-sm-12">
								<input type="date" id="student_birthdate" class="form-control" name="student_birthdate" value="<?=isset($student->student_birthdate) ? $student->student_birthdate : ''; ?>" />
							</div>
						</div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label class="col-sm-12 col-form-label"> Jenis Kelamin </label>
							<div class="col-sm-12">
								<select id="student_gender" name="student_gender" class="form-control">
									<datalist>
										<option value="">Pilih Gender</option>
										<option value="1" <?=isset($student->student_gender) && $student->student_gender == '1' ? 'selected' : ''; ?>>Laki-laki</option>
										<option value="2" <?=isset($student->student_gender) && $student->student_gender == '2' ? 'selected' : ''; ?>>Perempuan</option>
									</datalist>
								</select>
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="student_phone" class="col-sm-12 col-form-label"> Phone </label>
							<div class="col-sm-12">
								<input type="text" id="student_phone" class="form-control" name="student_phone" value="<?=isset($student->student_phone) ? $student->student_phone : ''; ?>" />
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
											<option value="<?=$prov->province_id;?>" <?=isset($student->province_id) && $student->province_id == $prov->province_id ? 'selected' : ''; ?>><?=$prov->province_name;?></option>
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
												<option value="<?=$dist->district_id;?>" <?=isset($student->district_id) && $student->district_id == $dist->district_id ? 'selected' : ''; ?>><?=$dist->district_name;?></option>
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
												<option value="<?=$sdist->subdistrict_id;?>" <?=isset($student->subdistrict_id) && $student->subdistrict_id == $sdist->subdistrict_id ? 'selected' : ''; ?>><?=$sdist->subdistrict_name;?></option>
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
								<select id="village" name="student_geo_address" class="select-village form-control">
									<datalist>
									<?php if($this->input->post("action") == 'new') { ?>
										<option value="">Pilih Kelurahan</option>
									<?php } else { ?>
										<?php if($vlgs->num_rows() > 0) { ?>
											<option value="">Pilih Kabupaten/Kota</option>
											<?php foreach($vlgs->result() as $vlg) { ?>
												<option value="<?=$vlg->village_id;?>" <?=isset($student->village_id) && $student->village_id == $vlg->village_id ? 'selected' : ''; ?>><?=$vlg->village_name;?></option>
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
						<label for="student_address" class="col-sm-12 col-form-label"> Alamat</label>
						<div class="col-sm-12">
							<textarea id="student_address" class="form-control" name="student_address" ><?=isset($student->student_address) ? $student->student_address : ''; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-sm-12 form-group">
					<label class="col-form-label">Data Alamat Domisili</label>
					<div class="form-group row mb-0">
						<div class="col-sm-6 form-group">
							<label for="dom_province" class="col-sm-12 col-form-label"> Provinsi </label>
							<div class="col-sm-12">
								<select id="dom_province" class="select-province form-control" data-district="dom_district">
									<datalist>
									<?php if($provs->num_rows() > 0) { ?>
										<option value="">Select Province</option>
										<?php foreach($provs->result() as $prov) { ?>
											<option value="<?=$prov->province_id;?>" <?=isset($student->dom_province_id) && $student->dom_province_id == $prov->province_id ? 'selected' : ''; ?>><?=$prov->province_name;?></option>
										<?php } ?>
									<?php } else { ?>
										<option value="">No Data</option>
									<?php } ?>
									</datalist>
								</select>
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<label for="dom_district" class="col-sm-12 col-form-label"> Kabupaten/Kota </label>
							<div class="col-sm-12">
								<select id="dom_district" class="select-district form-control" data-subdistrict="dom_subdistrict">
									<datalist>
									<?php if($this->input->post("action") == 'new') { ?>
										<option value="">Pilih Kabupaten/Kota</option>
									<?php } else { ?>
										<?php if($dists->num_rows() > 0) { ?>
											<option value="">Pilih Kabupaten/Kota</option>
											<?php foreach($dists->result() as $dist) { ?>
												<option value="<?=$dist->district_id;?>" <?=isset($student->dom_district_id) && $student->dom_district_id == $dist->district_id ? 'selected' : ''; ?>><?=$dist->district_name;?></option>
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
							<label for="dom_subdistrict" class="col-sm-12 col-form-label"> Kecamatan </label>
							<div class="col-sm-12">
								<select id="dom_subdistrict" class="select-subdistrict form-control" data-village="dom_village">
									<datalist>
									<?php if($this->input->post("action") == 'new') { ?>
										<option value="">Pilih Kecamatan</option>
									<?php } else { ?>
										<?php if($sdists->num_rows() > 0) { ?>
											<option value="">Pilih Kecamatan</option>
											<?php foreach($sdists->result() as $sdist) { ?>
												<option value="<?=$sdist->subdistrict_id;?>" <?=isset($student->dom_subdistrict_id) && $student->dom_subdistrict_id == $sdist->subdistrict_id ? 'selected' : ''; ?>><?=$sdist->subdistrict_name;?></option>
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
							<label for="dom_village" class="col-sm-12 col-form-label"> Kelurahan </label>
							<div class="col-sm-12">
								<select id="dom_village" name="student_dom_geo_address" class="select-village form-control">
									<datalist>
									<?php if($this->input->post("action") == 'new') { ?>
										<option value="">Pilih Kelurahan</option>
									<?php } else { ?>
										<?php if($vlgs->num_rows() > 0) { ?>
											<option value="">Pilih Kabupaten/Kota</option>
											<?php foreach($vlgs->result() as $vlg) { ?>
												<option value="<?=$vlg->village_id;?>" <?=isset($student->dom_village_id) && $student->dom_village_id == $vlg->village_id ? 'selected' : ''; ?>><?=$vlg->village_name;?></option>
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
						<label for="student_dom_address" class="col-sm-12 col-form-label"> Alamat</label>
						<div class="col-sm-12">
							<textarea id="student_dom_address" class="form-control" name="student_dom_address" ><?=isset($student->student_dom_address) ? $student->student_dom_address : ''; ?></textarea>
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