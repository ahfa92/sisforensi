<?php
	include 'header.php';
?>
<div class="d-flex flex-grow-1">
<?php
	include 'sidebar.php';
?>
<main role="main" class="col-md-10 h-100 flex-grow-1">
	<div class="col-12 mb-4">
		<h2 class="page-title">Pembagian Kelas</h2>
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
	<div class="col-12">
		<form action="" class="form-inline">
			<div class="input-group mb-2 mr-sm-2">
			    <div class="input-group-prepend">
			    	<div class="input-group-text">Tahun Ajaran</div>
			    </div>
				<select id="edu_year_id" name="edu_year_id" class="form-control">
				<?php if($edu_years->num_rows() > 0) { ?>
					<?php foreach($edu_years->result() as $edu_year) { ?>
						<option value="<?=$edu_year->edu_year_id?>" <?=($edu_year->edu_year_id == $default_year->edu_year_id ? "selected" : "");?>><?=$edu_year->edu_year_name;?></option>
					<?php } ?>
				<?php } ?>
				</select>
			</div>
		</form>
	</div>
	<div class="col-12 table-responsive">
		<table id="table-class" class="table table-hover datatables">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Kelas</th>
					<th>Tingkat</th>
					<th>Tahun Ajar</th>
					<th>Jumlah Siswa</th>
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
					<td><?=($class->assignment) ? $class->assignment->edu_year_name : $default_year->edu_year_name; ?></td>
					<td id="class-<?=$class->class_id;?>"><?=($class->assignment) ? $class->assignment->students : '0' ?></td>
					<td style="max-width: 20%;">
						<div class="d-flex w-100">
							<form class="col-auto px-1" method="post">
								<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-info" onclick="openassignment('<?=$class->class_id?>')"><i class="fa fa-users"></i></button>
							</form>
							<form action="<?=site_url('jadwal');?>" class="col-auto px-1">
								<input type="hidden" name="class_id" value="<?=$class->class_id?>" />
								<input type="hidden" name="edu_year_id" value="<?=($class->assignment) ? $class->assignment->edu_year_id : $default_year->edu_year_id; ?>" />
								<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-calendar"></i></button>
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
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal-body" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	function openassignment(class_id) {
		$.ajax({
				url: "<?=site_url('api/assignment')?>",
				data: {class_id:class_id,edu_year_id:$('#edu_year_id').val()},
				dataType:"json"
			}).done(function(resp){
				$('#modal-title').html(resp.title);
				$('#modal-body').html(resp.html);
				$('#modal-info').modal('show');
			});
	}

	$('#modal-info').on('hidden.bs.modal',function(e){
		$('#edu_year_id').change();		
	});

	$('#edu_year_id').on('change',function(e){
		$(this).closest("form").submit();
	});

</script>
</body>
</html>