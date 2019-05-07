<script type="text/javascript" src="<?=base_url('assets/js/jquery-3.4.0.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>" async defer></script>
<script type="text/javascript" src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript">
	$('li.nav-item').on('click',function(e){
		if(!($(this).hasClass('active'))){
			$(this).addClass('active');
			$(this).siblings('.active:first').removeClass('active');
		}
	})
</script>
<script type="text/javascript">
	$('.datatables').dataTable();
</script>
