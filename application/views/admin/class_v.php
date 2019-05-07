<?php
	include 'header.php';
?>
<div class="d-flex flex-grow-1">
<?php
	include 'sidebar.php';
?>
<main role="main" class="col-md-auto h-100 flex-grow-1">
	<div class="col-12 mb-4">
		<h2 class="page-title">Kelas</h2>
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
		<table id="table-class" class="table table-hover datatables">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Kelas</th>
					<th>Tingkat</th>
					<th style="max-width: 20%;">Action</th>
				</tr>
			</thead>
			<?php 
			if($classes->num_rows() > 0){
				$no = 1;
			?>
			<tbody>
			<?php foreach($classes->result() as $class){ ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$class->class_name?></td>
					<td><?=$class->class_tier?></td>
					<td style="max-width: 20%;">
						<div class="d-flex w-100">
							<form class="col-auto px-1" method="post">
								<input type="hidden" name="class_id" value="<?=$class->class_id?>" />
								<input type="hidden" name="action" value="edit" />
								<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
							</form>
							<form class="col-auto px-1" method="post">
								<input type="hidden" name="class_id" value="<?=$class->class_id?>" />
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