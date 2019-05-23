<?php
	include 'header.php';
?>
<div class="d-flex flex-grow-1 vw-100">
<?php
	include 'sidebar.php';
?>
<main role="main" class="col-md-10 h-100 flex-grow-1">
	<div class="col-12 mb-4">
		<h2 class="page-title">Data Guru</h2>
	</div>

	<?php if(!empty($page['message'])){ ?>
	<div class="col-12 mb-4">
		<div class="alert alert-success alert-dismissible fade show" role="alert"><?=$page['message']?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php } ?>
	<div class="col-12 mb-4 text-right">
		<form action="" method="post">
			<button type="submit" name="action" value="new" class="btn btn-primary">
				<h4 class="mb-0 mx-5">New</h4>
			</button>
		</form>
	</div>
	<div class="col-12 table-responsive">
		<table id="table-teacher" class="table table-hover datatables">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Depan</th>
					<th>Nama Belakang</th>
					<th>NIP</th>
					<th>Alamat</th>
					<th>Tanggal Lahir</th>
					<th>Tanggal Bergabung</th>
					<th style="max-width: 20%;">Action</th>
				</tr>
			</thead>
			<?php 
			if($teachers->num_rows() > 0){
				$no = 1;
			?>
			<tbody>
			<?php foreach($teachers->result() as $teacher){ ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$teacher->teacher_firstname?></td>
					<td><?=$teacher->teacher_lastname?></td>
					<td><?=$teacher->nip?></td>
					<td>
						<?=$teacher->teacher_address?>
						<?=(!empty($teacher->teacher_geo_address)) ? '<br/>'.$teacher->village_name.', '.$teacher->subdistrict_name.', '.$teacher->district_name.', '.$teacher->province_name : '';?> 
					</td>
					<td><?=(new DateTime($teacher->teacher_birthdate))->format("d M Y");?></td>
					<td><?=(new DateTime($teacher->teacher_joindate))->format("d M Y");?></td>
					<td style="max-width: 20%;">
						<div class="d-flex w-100">
							<form class="col-auto px-1" method="post">
								<input type="hidden" name="teacher_id" value="<?=$teacher->teacher_id?>" />
								<input type="hidden" name="action" value="edit" />
								<button type="submit" class="btn btn-warning btn-sm" style="color:white;"><i class="fa fa-edit"></i></button>
							</form>
							<form class="col-auto px-1" method="post"> 
								<input type="hidden" name="teacher_id" value="<?=$teacher->teacher_id?>" />
								<input type="hidden" name="action" value="delete" />
								<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-window-close"></i></button>
							</form>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
			<?php } ?>
		</table>
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