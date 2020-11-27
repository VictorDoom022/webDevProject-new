<?php
include_once('config/bootstrap.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<?php echo $bootstrapCSS; echo $jQueryJS; echo $bootstrapJS ?>
</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
				<div class="card px-5 pb-2">
				<form method="post" action="functions/login_function.php">
					<div class="row">
						<div class="col-md-12">
							Username: 
							<input type="text" class="form-control form-control-sm" name="username">
						</div>
						<div class="col-md-12">
							Password: 
							<input type="password" class="form-control form-control-sm" name="password">
						</div>
						<div class="col-md-12 mt-2 text-right">
							<input type="submit" class="btn btn-sm btn-primary" name="login" value="login"/>
						</div>
					</div>
				</form>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>