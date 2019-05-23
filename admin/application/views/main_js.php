<script type="text/javascript" src="<?=base_url('assets/js/jquery-3.4.0.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>" async defer></script>
<script type="text/javascript" src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/jquery.multi-select.js')?>"></script>
<script type="text/javascript">
	$('li.nav-item').on('click',function(e){
		if(!($(this).hasClass('active'))){
			$(this).addClass('active');
			$(this).siblings('.active:first').removeClass('active');
		}
	})
</script>
<script type="text/javascript">
	$('.select-province').on('change',function(e){
		let old = $(this).attr('data-old');
		let dist = $("#"+$(this).attr('data-district'));
		let province = $(this).val();

		$(this).attr('data-old',province);

		if(province != old || province == ''){
			dist.find('option').not(':first').remove();
			dist.val('');
			if(province.length){	
				$.ajax({
					url: "<?=site_url('api/districts')?>",
					data: {province_id:province},
					dataType:"json"
				}).done(function(resp){
					dist.append(resp.html);
				});
			}
			dist.change();
		}
	});

	$('.select-district').on('change',function(e){
		let old = $(this).attr('data-old');
		let subdist = $("#"+$(this).attr('data-subdistrict'));
		let district = $(this).val();

		$(this).attr('data-old',district);

		if(district != old || district == ''){
			subdist.find('option').not(':first').remove();
			subdist.val('');
			if(district.length){
				$.ajax({
					url: "<?=site_url('api/subdistricts')?>",
					data: {district_id:district},
					dataType:"json"
				}).done(function(resp){
					subdist.append(resp.html);
				});
			}
			subdist.change();
		}
	});

	$('.select-subdistrict').on('change',function(e){
		let old = $(this).attr('data-old');
		let village = $("#"+$(this).attr('data-village'));
		let subdistrict = $(this).val();
		
		$(this).attr('data-old',subdistrict);

		if(subdistrict != old || subdistrict == '') {
			village.find('option').not(':first').remove();
			village.val('');
			if(subdistrict.length){
				$.ajax({
					url: "<?=site_url('api/villages')?>",
					data: {subdistrict_id:subdistrict},
					dataType:"json"
				}).done(function(resp){
					village.append(resp.html);

				});
			}
			village.change();
		}
	});
</script>
<script type="text/javascript">
	$('.datatables').dataTable();
</script>
<script type="text/javascript">
	$('.change-submit').on('change',function(e){
		$(this).closest('form').submit();
	});
</script>
