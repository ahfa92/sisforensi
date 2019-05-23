<?php
	include 'header.php';
?>
<main role="main" class="w-100 min-vh-100 d-flex align-items-center justify-content-center">
	<div class="col-12 col-md-6 flex-item">
		<form action="" method="post">
			<?=(isset($page['error'])) ? '<div class="alert alert-warning alert-dismissible fade show">'.$page['error'].'</div>' : '' ?>
			<?=form_error('username', '<div class="alert alert-warning alert-dismissible fade show">', '</div>');?>
		  	<div class="form-group">
		  		<label for="username">Username</label>
		  		<input type="text" class="form-control" id="username" aria-describedby="username" name="username" placeholder="Username" required>
		  	</div>
			<?=form_error('username', '<div class="alert alert-warning alert-dismissible fade show">', '</div>');?>
		  	<div class="form-group">
		  		<label for="password">Password</label>
		  		<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
		  	</div>
		  	<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</main>
<?php
	include 'footer.php';
	include 'main_js.php';
?>
<script type="text/javascript">
	
</script>
</body>
</html>