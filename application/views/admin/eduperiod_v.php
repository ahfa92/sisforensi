<?php
	include 'header.php';
?>
<div class="d-flex flex-grow-1">
<?php
	include 'sidebar.php';
?>
<main role="main" class="col-md-10 h-100 flex-grow-1">
	<div class="col-12 mb-4">
		<h2 class="page-title">Tahun Ajar</h2>
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
		<table id="table-eduperiod" class="table table-hover datatables">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Periode Ajar</th>
					<th>Tahun Ajar</th>
					<th>Tipe Periode Ajar</th>
					<th>Periode Ke</th>
					<th>Tanggal Mulai Periode</th>
					<th>Tanggal Akhir Periode</th>
					<th style="max-width: 20%;">Action</th>
				</tr>
			</thead>
			<?php 
			if($eduperiods->num_rows() > 0){
				$no = 1;
			?>
			<tbody>
			<?php foreach($eduperiods->result() as $eduperiod){ ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$eduperiod->edu_period_code?></td>
					<td><?=$eduperiod->edu_year_name?></td>
					<td><?=periodtype($eduperiod->edu_period_type);?></td>
					<td><?=$eduperiod->edu_period_num?></td>
					<td><?=$eduperiod->edu_period_start?></td>
					<td><?=$eduperiod->edu_period_end?></td>
					<td style="max-width: 20%;">
						<div class="d-flex w-100">
							<form class="col-auto px-1" method="post">
								<input type="hidden" name="edu_period_id" value="<?=$eduperiod->edu_period_id?>" />
								<input type="hidden" name="action" value="edit" />
								<button type="submit" class="btn btn-warning btn-sm" style="color:white;"><i class="fa fa-edit"></i></button>
							</form>
							<form class="col-auto px-1" method="post"> 
								<input type="hidden" name="edu_period_id" value="<?=$eduperiod->edu_period_id?>" />
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